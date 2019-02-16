<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('age');
            $table->string('blood_group');
            $table->string('dob');
            $table->enum('gender', ['male', 'female']);
            $table->string('location');
            $table->string('contact');
            $table->string('emergency_contact');
            $table->date('appointment_date');
            $table->time('appointment_time');
            $table->enum('status', ['completed','in-process']);
            $table->string('note');

            $table->integer('hospital_id')->unsigned();
            $table->foreign('hospital_id')->references('id')->on('hospitals');

            $table->integer('doctor_id')->unsigned();
            $table->foreign('doctor_id')->references('id')->on('doctors');

            $table->integer('facility_id')->unsigned();
            $table->foreign('facility_id')->references('id')->on('facilities');

            $table->integer('relation__id')->unsigned();
            $table->foreign('relation_id')->references('id')->on('relations');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}
