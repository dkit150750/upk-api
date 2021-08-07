<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class LectureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $course_lectures = [
            [
                'date' => '2021-01-01',
                'time' => '12:30',
                'course_id' => '1',
            ],
            [
                'date' => '2021-01-02',
                'time' => '12:30',
                'course_id' => '1',
            ],
            [
                'date' => '2021-01-03',
                'time' => '12:30',
                'course_id' => '1',
            ],
            [
                'date' => '2021-01-04',
                'time' => '12:30',
                'course_id' => '1',
            ],
            [
                'date' => '2021-01-05',
                'time' => '12:30',
                'course_id' => '1',
            ],
            [
                'date' => '2021-01-06',
                'time' => '13:30',
                'course_id' => '1',
            ],
            [
                'date' => '2021-04-04',
                'time' => '14:20',
                'course_id' => '1',
            ],
            [
                'date' => '2021-01-04',
                'time' => '12:32',
                'course_id' => '1',
            ],
            [
                'date' => '2021-01-05',
                'time' => '12:36',
                'course_id' => '1',
            ],
            [
                'date' => '2021-01-06',
                'time' => '12:35',
                'course_id' => '1',
            ],
            [
                'date' => '2021-04-05',
                'time' => '12:30',
                'course_id' => '1',
            ],
            [
                'date' => '2021-04-06',
                'time' => '02:30',
                'course_id' => '1',
            ],
            [
                'date' => '2021-01-07',
                'time' => '15:30',
                'course_id' => '2',
            ],
            [
                'date' => '2021-01-08',
                'time' => '16:30',
                'course_id' => '2',
            ],
            [
                'date' => '2021-01-09',
                'time' => '12:30',
                'course_id' => '2',
            ],
            [
                'date' => '2021-01-10',
                'time' => '12:30',
                'course_id' => '2',
            ],
        ];
        DB::table('lectures')->insert($course_lectures);
    }
}
