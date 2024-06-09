<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('driver_id',)->nullable();
            $table->integer('company_id',)->nullable();
            $table->integer('car_type_id',)->nullable();
            $table->integer('car_sub_type_id',)->nullable();
            $table->string('pickup_location',256);
            $table->string('pickup_lat',256);
            $table->string('pickup_long',256);
            $table->string('destination',256);
            $table->string('destination_lat',256);
            $table->integer('total_seats',)->nullable();
            $table->string('destination_long',256);
            $table->string('destination_type')->nullable()->default('NULL');
            $table->time('arrival_time')->nullable();
            $table->time('pickup_time')->nullable();
            $table->time('return_time')->nullable();
            $table->date('return_date')->nullable();
            $table->datetime('accept_time')->nullable();
            $table->datetime('arrive_time')->nullable();
            $table->datetime('start_time')->nullable();
            $table->datetime('end_time')->nullable();
            $table->string('sharing_code')->nullable()->default('NULL');
            $table->integer('extended_booking_id',)->nullable();
            $table->integer('is_share',)->default('0');
            $table->integer('shared_booking_id',)->nullable();
            $table->integer('has_return',)->default('0');
            $table->integer('repeat_type',)->default('0');
            $table->datetime('expire_time')->nullable();
            $table->datetime('waiting_time')->nullable();
            $table->string('total_km',256);
            $table->integer('total_min',)->default('0');
            $table->string('estimated_amount',256)->default('0');
            $table->string('final_amount',256)->default('0');
            $table->string('admin_amount',256)->default('0');
            $table->string('company_amount',100)->default('0');
            $table->string('discount',256);
            $table->integer('schedule_duration',)->default('0');
            $table->integer('is_shared_booking',)->default('0');
            $table->integer('riding_with',)->nullable();
            $table->string('friendly_id')->nullable()->default('NULL');
            $table->integer('state_id',)->default('0');
            $table->integer('final_state',)->default('0');
            $table->integer('type_id',)->default('0');
            $table->datetime('created_on');
            $table->datetime('updated_on');
            $table->integer('created_by_id',);
            $table->integer('is_free',)->default('0');
            $table->integer('is_quiet_booking',)->default('0');
            $table->integer('is_temperature',)->default('0');
            $table->integer('is_luggage',)->default('0');
            $table->integer('is_schedule',)->default('0');
            $table->string('rejected_by_driver')->nullable()->default('NULL');
            $table->string('reason')->nullable()->default('NULL');
            $table->integer('promo_code_id',)->default('0');
            $table->integer('trip_fare',)->nullable();
            $table->integer('estimate_time',)->default('0');
            $table->datetime('schedule_time')->nullable();
            $table->string('token',128)->nullable()->default('NULL');
            $table->integer('payment_status',)->default('0');
            $table->string('alt_contact_no',32)->nullable()->default('NULL');
            $table->string('short_info')->nullable()->default('NULL');
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
        Schema::dropIfExists('booking');
    }
}
