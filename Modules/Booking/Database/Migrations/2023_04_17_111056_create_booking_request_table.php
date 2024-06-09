<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_request', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('booking_id',);
            $table->integer('driver_id',)->nullable();
            $table->integer('state_id',)->default('0');
            $table->integer('type_id',)->default('0');
            $table->datetime('created_on');
            $table->datetime('updated_on');
            $table->integer('created_by_id',);
            $table->string('reason')->nullable()->default('NULL');
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
        Schema::dropIfExists('booking_request');
    }
}
