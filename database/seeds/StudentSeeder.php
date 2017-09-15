<?php

use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=\Faker\Factory::create('zh_CN');
        for($i=0;$i<10;$i++){
            \DB::table('student')->insert([
                'std_name'=>$faker->name,
                'std_password'=>bcrypt('123456'),
                'std_email'=>$faker->email,
                'std_birthday'=>$faker->date(),
                'std_phone'=>$faker->phoneNumber,
                'std_sex'=>'男',
                'std_pic'=>$faker->imageUrl(),
                'std_desc'=>$faker->catchPhrase,
            ]);
        }
    }
}
