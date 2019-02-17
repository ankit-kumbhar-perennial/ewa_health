<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOtpToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {

            $table->string('otp')->after('password')->nullable();
            $table->string('otp_expired_at')->after('remember_token')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('users', 'otp' || Schema::hasColumn('users', 'otp_expired_at'))) {
            Schema::table('users', function (Blueprint $table) {

                $table->dropColumn('otp');
                $table->dropColumn('otp_expired_at');
            });
        }
    }

}

