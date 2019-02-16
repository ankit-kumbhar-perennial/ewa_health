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
            'logo' =>'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTBi0uLVg-vghwlSjWq53Ae5addmGihFvnL8HNcrZIjwAjqZOFOAw',
            'ratings'=>'2',
            'facility_id'=>'1',
            'doctor_id'=>'1',
        ]);

        DB::table('hospitals')->insert([
            'name' => 'Deenanath Mangeshkar',
            'address' => 'pune',
            'logo' =>'https://ahis.dmhospital.org/images/log-in-02.jpg',
            'ratings'=>'4',
            'facility_id'=>'2',
            'doctor_id'=>'2',
        ]);

        DB::table('hospitals')->insert([
            'name' => 'Jehangir Hospital',
            'address' => 'Deccan',
            'logo' =>'https://freedom01315.files.wordpress.com/2017/09/wellness_logo12016.jpg',
            'ratings'=>'3',
            'facility_id'=>'3',
            'doctor_id'=>'5',
        ]);

        DB::table('hospitals')->insert([
            'name' => 'Poona Hospital',
            'address' => 'Deccan',
            'logo' =>'https://images1-fabric.practo.com/poona-hospital-and-research-centre-pune-1467211542-5773df1637745.JPG',
            'ratings'=>'3',
            'facility_id'=>'2',
            'doctor_id'=>'5',
        ]);

        DB::table('hospitals')->insert([
            'name' => 'Chandralok Hospital',
            'address' => 'Deccan',
            'logo' =>'https://www.chandralokhospital.com/images/displayimage/82c7b2fc675ca6169c790c5252165b962560ee4954eea53c253e3.png?type=ld&size=300',
            'ratings'=>'3',
            'facility_id'=>'2',
            'doctor_id'=>'5',
        ]);


    }
}
