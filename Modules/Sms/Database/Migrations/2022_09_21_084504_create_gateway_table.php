<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGatewayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gateway', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('value')->nullable();
            $table->integer('mode')->default('0');
            $table->integer('state_id')->default('0');
            $table->integer('type_id')->default('0');
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
        Schema::dropIfExists('gateway');
    }
}
