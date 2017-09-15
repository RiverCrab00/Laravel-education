<?php

use Illuminate\Database\Seeder;

class CourseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('course')->insert([
            [
                'course_name'=>'PHP面向对象',
                'profession_id'=>1,
                'course_desc'=>'告送你如何搞定对象',
                'course_price'=>1234.56,
            ],
            [
                'course_name'=>'javascript高级编程',
                'profession_id'=>2,
                'course_desc'=>'高速你一招学会js高级编程',
                'course_price'=>5234.56,
            ],
            [
                'course_name'=>'jquery操作',
                'profession_id'=>3,
                'course_desc'=>'非常牛的课程，共5天课',
                'course_price'=>3234.56,
            ],
        ]);
    }
}
