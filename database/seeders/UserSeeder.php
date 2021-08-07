<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'lastname' => 'Иванов',
                'name' => 'Валентин',
                'patronymic' => 'Степанов',
                'email' => 'teleskop150750@gmail.com',
                'password' => Hash::make('password'),
            ],
            [
                'lastname' => 'Иванов',
                'name' => 'Петя',
                'patronymic' => 'Степанов',
                'email' => 'dkit150750@gmail.com',
                'password' => Hash::make('password'),
            ],
        ];
        DB::table('users')->insert($users);
    }
}
