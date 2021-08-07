<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courses = [
            [
                'title' => 'Сетевое и сестемное администрирование',
                'description' => 'Описание 1',
                'background' => 'hsl(42, 93%, 85%)',
            ],
            [
                'title' => 'Программные решения для бизнеса',
                'description' => 'Описание 1',
                'background' => 'hsl(144, 70%, 79%)',
            ],
            [
                'title' => 'Корпоративная защита от внутренних угроз информационной безопасности',
                'description' => 'Описание 1',
                'background' => 'hsl(240, 80%, 89%)',
            ],
            [
                'title' => 'Веб-дизайн и разработка',
                'description' => 'Описание 1',
                'background' => 'hsl(193, 100%, 90%)',
            ],
            [
                'title' => 'ИТ-решения для бизнеса на платформе 1С:Предприятие',
                'description' => 'Описание 1',
                'background' => 'hsl(39, 100%, 79%)',
            ],
            [
                'title' => 'Разработка решений с использованием блокчейн технологий',
                'description' => 'Описание 1',
                'background' => 'hsl(33, 71%, 93%)',
            ],
        ];
        \DB::table('courses')->insert($courses);
    }
}
