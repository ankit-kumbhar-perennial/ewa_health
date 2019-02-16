<?php

use Illuminate\Database\Seeder;

class HospitalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hospitals')->insert([
            'name' => 'Sahyadri hospital',
            'address' => 'Kothrudh',
            'logo' =>'',
            'ratings'=>'2',
            'facility_id'=>'1',
            'doctor_id'=>'1',
        ]);

        DB::table('hospitals')->insert([
            'name' => 'Deenanath Mangeshkar',
            'address' => 'pune',
            'logo' =>'',
            'ratings'=>'4',
            'facility_id'=>'2',
            'doctor_id'=>'2',
        ]);

        DB::table('hospitals')->insert([
            'name' => 'Jehangir Hospital',
            'address' => 'Deccan',
            'logo' =>'',
            'ratings'=>'3',
            'facility_id'=>'3',
            'doctor_id'=>'5',
        ]);

        DB::table('hospitals')->insert([
            'name' => 'Poona Hospital',
            'address' => 'Deccan',
            'logo' =>'',
            'ratings'=>'3',
            'facility_id'=>'2',
            'doctor_id'=>'5',
        ]);

        DB::table('hospitals')->insert([
            'name' => 'Chandralok Hospital',
            'address' => 'Deccan',
            'logo' =>'',
            'ratings'=>'3',
            'facility_id'=>'2',
            'doctor_id'=>'5',
        ]);


    }
}
