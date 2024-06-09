<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumns('users', ['transport_type', 'driver_tag', 'email_verified'])) {
            Schema::table('users', function (Blueprint $table) {
                $table->integer('transport_type')->default(0)->after('is_online');
                $table->integer('driver_tag')->default(0)->after('transport_type');
                $table->integer('email_verified')->default(0)->after('driver_tag');
                $table->string('referral_reward')->default(0)->after('email_verified');
                $table->index(['referral_code', 'transport_type']);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumns('users', ['transport_type', 'driver_tag', 'email_verified'])) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('transport_type');
                $table->dropColumn('driver_tag');
                $table->dropColumn('email_verified');
                $table->dropColumn('referral_code');
            });
        }
    }
}
