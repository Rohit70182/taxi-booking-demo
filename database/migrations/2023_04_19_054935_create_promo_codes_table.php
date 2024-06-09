<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromoCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promo_codes', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->text('description')->nullable();	
            $table->string('value')->nullable();
            $table->integer('max_uses')->nullable();	
            $table->integer('max_uses_per_user')->nullable();	
            $table->timestamp('start_date')->nullable();	
            $table->timestamp('expiry_date')->nullable();	
            $table->integer('state_id')->default(0);
            $table->integer('type_id')->default(0);
            $table->integer('created_by_id');
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
        Schema::dropIfExists('promo_codes');
    }
}
