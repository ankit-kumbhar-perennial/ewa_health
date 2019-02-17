<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDropColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('appointments', function (Blueprint $table)
        {
            $table->string('facility');
            $table->string('hospital');
            $table->enum('payment_mode', ['cash', 'card']);
            $table->dropColumn('blood_group');
            $table->dropColumn('dob');
            $table->dropColumn('emergency_contact');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
