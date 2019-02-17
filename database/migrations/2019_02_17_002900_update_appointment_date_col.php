<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateAppointmentDateCol extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropColumn('appointment_date');
            $table->dropColumn('appointment_time');
            $table->dropColumn('relation_id');
            $table->dropColumn('note');
            $table->dropColumn('appointment_date');
        });

        Schema::table('appointments', function (Blueprint $table) {
            $table->string('note')->nullable();
            $table->string('appointment_date')->after('key');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('appointments', function (Blueprint $table) {
            $table->date('appointment_date');
            $table->time('appointment_time');
            $table->integer('relation_id');
            $table->datetime('appointment_date');
        });
    }
}
