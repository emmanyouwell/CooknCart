<?php

namespace App\Imports;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
           'name'     => $row['name'],
           'lname'     => $row['lname'],
           'email'    => $row['email'], 
           'password' => Hash::make('password'),
           'phone'    => $row['phone'], 
           'address'    => $row['address'], 
           'city'    => $row['city'], 
           'pincode'    => $row['pincode'], 
           'role_as'    => 0, 

        ]);
    }
}
