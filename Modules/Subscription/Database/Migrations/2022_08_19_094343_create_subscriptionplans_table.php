<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionplansTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('subscriptionplans')) {
            Schema::create('subscriptionplans', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->string('description');
                $table->integer('validity');
                $table->string('price');
                $table->string('big_text')->nullable();
                $table->integer('state_id')->default(0);
                $table->integer('type')->nullable();
                $table->integer('created_by_id')->nullable();
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
        Schema::dropIfExists('subscriptionplans');
    }
}
