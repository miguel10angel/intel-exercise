<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function getUsers(){
        $users = User::all();
        return response([ 'users' => $users ]);
    }

    public function create(Request $request){
        $response=[
            'result' => 'error',
            'type' => 'error'
        ];
        $fields = [];

        try{
            $encode = json_encode($request->data);
            $decode = json_decode($encode);
            
            foreach($decode as $key ){
                $fields[$key->name] = $key->value;
            }

            $validator = Validator::make($fields ,
            [
                'name' => 'required',
                'last_name' => 'required',
                'phone' => 'required',
                'age' => 'required|Integer',
                'ingresed_at' => 'required|date',
            ]);
    
            if ($validator->fails()) {
                $response ['message'] = $validator->messages()->first();
                return $response;
            }
    
            $file_base_64 = $request->file;
    
            if (preg_match('/^data:image\/(\w+);base64,/', $file_base_64))
            {
                $data = substr($file_base_64, strpos($file_base_64, ',') + 1);
                $data = base64_decode($data);
                $new_file_name = 'user_' . uniqid();
                Storage::disk('public')->put($new_file_name, $data);

                $user = User::create([
                    'name' => $fields['name'],
                    'last_name' => $fields['last_name'],
                    'age' => $fields['age'],
                    'phone' => $fields['phone'],
                    'ingresed_at' => $fields['ingresed_at'],
                    'file' => $new_file_name
                ]);
                
                $response['result'] = 'Ok';
                $response['message'] = 'Usuario registrado correctamente';
                $response['type'] = 'success';
                $response['user'] = $user;
            }else
            {
                $response['result'] = 'error';
                $response['message'] = 'El archivo no es una imagen';
            }

        }catch(\Exception $ex){
            \Log::info($ex->getMessage());
            $response['message'] = $ex->getMessage();
        }

        return $response;
    }


    public function update(Request $request){
        $response=[
            'result' => 'error'
        ];
        $fields = [];

        try{
            $encode = json_encode($request->data);
            $decode = json_decode($encode);
            
            foreach($decode as $key ){
                $fields[$key->name] = $key->value;
            }

            $validator = Validator::make($fields ,
            [
                'name' => 'required',
                'last_name' => 'required',
                'phone' => 'required',
                'age' => 'required|Integer',
                'ingresed_at' => 'required|date',
            ]);
    
            if ($validator->fails()) {
                $response ['message'] = $validator->messages()->first();
                return $response;
            }
    
            $user= User::find($fields['id']);
            $user->update([
                'name' => $fields['name'],
                'last_name' => $fields['last_name'],
                'age' => $fields['age'],
                'phone' => $fields['phone'],
                'ingresed_at' => $fields['ingresed_at']
            ]);

            $response['result'] = 'Ok';

        }catch(\Exception $ex){
            \Log::info($ex->getMessage());
            $response['message'] = $ex->getMessage();
        }

        return $response;
    }

    public function getUser(User $user){
        return response([ 'user' => $user ]);
    }

    public function delete(User $user){
        $response = [
            'result'=> 'error'
        ];
        try
        {
            $user->delete();
            $response['result'] = 'ok';
        }catch(\Exception $ex)
        {
            \Log::info($ex->getMessage());
        }

        return $response;
    } 
}


