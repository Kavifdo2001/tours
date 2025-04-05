<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [

            [

               'name'=>'Admin',

               'email'=>'admin@gmail.com',

               'type'=>1,

               'password'=> bcrypt('Admin123'),

            ],
            [

                'name'=>'Guide',

                'email'=>'guide@gmail.com',

                'type'=> 2,

                'password'=> bcrypt('Guide123'),

             ],

            [

               'name'=>'User',

               'email'=>'user@gmail.com',

               'type'=>0,

               'password'=> bcrypt('User123'),

            ],

        ];



        foreach ($users as $key => $user) {

            User::create($user);

        }
    }
}
