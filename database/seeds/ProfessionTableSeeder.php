<?php

use Illuminate\Database\Seeder;

class ProfessionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profession')->insert([
            [
                'profession_name'=>'PHP语言',
                'profession_desc'=>'世界上最好的语言'
            ],
            [
                'profession_name'=>'linux高级运维',
                'profession_desc'=>'世界上最好的运维'
            ],
            [
                'profession_name'=>'H5&全栈',
                'profession_desc'=>'世界上最好的专业'
            ],
        ]);
    }
}
