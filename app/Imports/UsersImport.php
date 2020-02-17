<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class UsersImport implements ToCollection
{
    public $users;
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        $users = [];
        foreach ($rows as $row) 
        {
            try{
                $user = User::create([
                    'name' => $row[0],
                    'last_name' => $row[1],
                    'phone' => $row[2],
                    'age' => (int)$row[3],
                    'ingresed_at' => date('Y-m-d',strtotime($row[4])),
                    'file' => 'default.png'
                ]);
                $users[] = $user;
            }catch(\Exception $ex){
                \Log::info($ex->getMessage());
            }
        }
        $this->users= $users;
    }
}
