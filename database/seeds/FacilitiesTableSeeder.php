<?php

use Illuminate\Database\Seeder;

class FacilitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('facilities')->insert([
            'id' => '1',
            'name' => 'bloodtest',
            'hospital_id' =>'1',
        ]);
        DB::table('facilities')->insert([
            'id' => '2',
            'name' => 'ECG',
            'hospital_id' =>'2',
        ]);
        DB::table('facilities')->insert([
            'id' => '3',
            'name' => 'heart_checkup',
            'hospital_id' =>'3',
        ]);
        DB::table('facilities')->insert([
            'id' => '4',
            'name' => 'Bone Density',
            'hospital_id' =>'4',
        ]);
        DB::table('facilities')->insert([
            'id' => '5',
            'name' => 'CT Scan',
            'hospital_id' =>'5',
        ]);
        DB::table('facilities')->insert([
            'id' => '6',
            'name' => 'X Ray',
            'hospital_id' =>'3',
        ]);
        DB::table('facilities')->insert([
            'id' => '7',
            'name' => 'bloodtest',
            'hospital_id' =>'2',
        ]);
        DB::table('facilities')->insert([
            'id' => '8',
            'name' => 'bloodtest',
            'hospital_id' =>'1',
        ]);
        DB::table('facilities')->insert([
            'id' => '8',
            'name' => 'Protein test',
            'hospital_id' =>'2',
        ]);
        DB::table('facilities')->insert([
            'id' => '8',
            'name' => 'Biopsy',
            'hospital_id' =>'1',
        ]);
    }
}
