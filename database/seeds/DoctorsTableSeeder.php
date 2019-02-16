<?php

use Illuminate\Database\Seeder;

class DoctorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('doctors')->insert([
            'name' => 'Ankit Kumbhar',
            'photo' => '',
            'education' => 'MBBS',
            'experience' => '5 yrs',
            'ratings' =>'7.8',
            'comments'=> '',
            'hospital_id'=> '2',
            'appointment_id'=>'1',
            'gender' =>'male',
        ]);

        DB::table('doctors')->insert([
            'name' => 'Manali Datar',
            'photo' => '',
            'education' => 'MBBS',
            'experience' => '3 yrs',
            'ratings' =>'6.5',
            'comments'=> '',
            'hospital_id'=> '1',
            'appointment_id'=>'4',
            'gender' =>'female',
        ]);

        DB::table('doctors')->insert([
            'name' => 'Saurabh Puranik',
            'photo' => '',
            'education' => 'MD',
            'experience' => '5.7 yrs',
            'ratings' =>'6',
            'comments'=> '',
            'hospital_id'=> '3',
            'appointment_id'=>'6',
            'gender' =>'male',
        ]);

        DB::table('doctors')->insert([
            'name' => 'Sujit',
            'photo' => '',
            'education' => 'MD',
            'experience' => '7 yrs',
            'ratings' =>'7.8',
            'comments'=> '',
            'hospital_id'=> '3',
            'appointment_id'=>'1',
            'gender' =>'male',
        ]);

        DB::table('doctors')->insert([
            'name' => 'Ram Bhale',
            'photo' => '',
            'education' => 'BAMS',
            'experience' => '5 yrs',
            'ratings' =>'7.8',
            'comments'=> '',
            'hospital_id'=> '5',
            'appointment_id'=>'2',
            'gender' =>'male',
        ]);

        DB::table('doctors')->insert([
            'name' => 'Nisha Pamnani',
            'photo' => '',
            'education' => 'BHMS',
            'experience' => '6.9 yrs',
            'ratings' =>'3 yrs',
            'comments'=> '',
            'hospital_id'=> '7',
            'appointment_id'=>'3',
            'gender' =>'female',
        ]);

        DB::table('doctors')->insert([
            'name' => 'Sushant',
            'photo' => '',
            'education' => 'MBBS',
            'experience' => '5 yrs',
            'ratings' =>'7.1 yrs',
            'comments'=> '',
            'hospital_id'=> '5',
            'appointment_id'=>'5',
            'gender' =>'male',
        ]);

        DB::table('doctors')->insert([
            'name' => 'Nikita',
            'photo' => '',
            'education' => 'MD',
            'experience' => '9 yrs',
            'ratings' =>'9',
            'comments'=> '',
            'hospital_id'=> '5',
            'appointment_id'=>'3',
            'gender' =>'female',
        ]);

        DB::table('doctors')->insert([
            'name' => 'Raghav Dwivedi',
            'photo' => '',
            'education' => 'MS',
            'experience' => '11 yrs',
            'ratings' =>'8.9',
            'comments'=> '',
            'hospital_id'=> '7',
            'appointment_id'=>'5',
            'gender' =>'male',
        ]);

        DB::table('doctors')->insert([
            'name' => 'Kunal Ahirrao',
            'photo' => '',
            'education' => 'MS',
            'experience' => '7 yrs',
            'ratings' =>'7.7 yrs',
            'comments'=> '',
            'hospital_id'=> '5',
            'appointment_id'=>'6',
            'gender' =>'male',
        ]);
    }
}
