<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class UserLectureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_lectures = [
            [
                'lecture_id' => '1',
                'user_id' => '1',
            ],
            [
                'lecture_id' => '2',
                'user_id' => '1',
            ],
            [
                'lecture_id' => '3',
                'user_id' => '1',
            ],
        ];
        DB::table('lecture_user')->insert($user_lectures);
    }
}
