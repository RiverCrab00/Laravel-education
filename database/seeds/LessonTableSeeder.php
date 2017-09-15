<?php

use Illuminate\Database\Seeder;

class LessonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lesson')->insert([
            [
                'lesson_name'=>'PHP变量',
                'course_id'=>1,
                'lesson_desc'=>'PHP变量通俗易懂，以后不在变量',
                'lesson_length'=>'20'
            ],
            [
                'lesson_name'=>'PHP数组',
                'course_id'=>1,
                'leson_desc'=>'PHP数组通俗易懂非常好学',
                'lesson_length'=>'30'
            ],
            [
                'lesson_name'=>'linux的环境搭建',
                'course_id'=>2,
                'leson_desc'=>'搭建非常容易',
                'lesson_length'=>'40'
            ],
            [
                'lesson_name'=>'cp命令的讲解',
                'course_id'=>2,
                'leson_desc'=>'详解语法',
                'lesson_length'=>'10'
            ],
            [
                'lesson_name'=>'jquery的安装',
                'course_id'=>3,
                'leson_desc'=>'搭建非常容易',
                'lesson_length'=>'40'
            ],
            [
                'lesson_name'=>'jquery的插件使用',
                'course_id'=>3,
                'leson_desc'=>'详解语法',
                'lesson_length'=>'10'
            ]

        ]);
    }
}
