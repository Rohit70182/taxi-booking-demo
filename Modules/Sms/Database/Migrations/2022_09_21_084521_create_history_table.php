<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history', function (Blueprint $table) {
            $table->id();
            $table->string('from');
            $table->string('to');
            $table->integer('model_id')->nullable();
            $table->string('model_type')->nullable();
            $table->string('text')->nullable();
            $table->integer('gateway_id');
            $table->string('sms_details')->nullable();
            $table->integer('state_id')->nullable();
            $table->integer('type_id')->nullable();
            $table->integer('created_by_id')->nullable();
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
        Schema::dropIfExists('history');
    }
}
