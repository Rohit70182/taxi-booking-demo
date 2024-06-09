<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionBillingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('subscription_billings')) {
        Schema::create('subscription_billings', function (Blueprint $table) {
            $table->id();
            $table->integer('subscription_id');
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->integer('type_id');
            $table->integer('state_id');
            $table->timestamps();
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
        Schema::dropIfExists('subscription_billings');
    }
}
