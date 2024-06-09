<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatalogSubcategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalog_subcategory', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->string('title')->nullable();
            $table->integer('state_id')->default(1);
            $table->integer('created_by_id')->nullable();
            $table->integer('type_id')->default(0);
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
        Schema::dropIfExists('catalog_subcategory');
    }
}
