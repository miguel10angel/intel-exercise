<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Imports\UsersImport;
use App\Models\User;
use Illuminate\Http\Request;
use Excel;

class ImportController extends Controller
{
    public function index(){
        return view('import');
    }

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
