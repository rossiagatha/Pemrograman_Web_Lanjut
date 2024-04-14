<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LoginUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'name'=>'Admin',
                'username'=>'admin',
                'role'=>'admin',
                'password'=>bcrypt('12345')
            ],
            [
                'name'=>'Manager',
                'username'=>'manager',
                'role'=>'manager',
                'password'=>bcrypt('12345')
            ],
            [
                'name'=>'Staff/Kasir',
                'username'=>'staff',
                'role'=>'staff',
                'password'=>bcrypt('12345')
            ],
        ];

        foreach($userData as $key => $val) {
            User::create($val);
        }
        
    }
}
