<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Imports\UsersImport;
use App\Models\User;
use Excel;

class ImportController extends Controller
{
    /**
     * Redirecciona a la vista para importar archivos
     *
     * @return view
     */
    public function index(){
        return view('import');
    }

    /**
     * Recive un archivo en base_64 y lo procesa para hacer el registro masivo de usuarios
     *
     * @param Request $request
     * @return Array $reponse
     */
    public function uploadexcel(Request $request)
    {
        $response = [
            'result' => 'error'
        ];

        try{
            $file_base_64 = $request->file;
            $data = substr($file_base_64, strpos($file_base_64, ',') + 1);
            $data = base64_decode($data);
            $new_file_name = 'import_' . uniqid(). '.xlsx';
            Storage::disk('public')->put($new_file_name, $data);

            if($request->delete_rows == 'true'){
                User::query()->truncate();
            }
            
            $import = new UsersImport;
            Excel::import($import, public_path() . '/files/users/' . $new_file_name);

            $response['data'] = $import->users;
            $response['result'] = 'ok';

        }catch(\Exception $ex){
            \Log::info($ex->getMessage());
        }
        return $response;
    }
}
