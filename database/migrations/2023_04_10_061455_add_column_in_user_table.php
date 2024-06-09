<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnInUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasColumns('users', ['first_name', 'last_name', 'customer_id', 'date_of_birth', 'gender', 'avg_rating', 'total_reviews', 'contact_no', 'country_code', 'address', 'district', 'latitude', 'longitude', 'state', 'city', 'country', 'zipcode', 'language', 'profile_file', 'referral_code', 'id_proof_file', 'license_file', 'company_id', 'step', 'otp', 'otp_timeout', 'otp_verified', 'is_available', 'is_booked', 'driver_number', 'driver_type', 'is_proof_verify', 'is_license_verify', 'is_authorize_verify', 'state_id', 'type_id', 'last_visit_time', 'activation_key', 'last_password_change', 'login_error_count', 'is_social_login', 'timezone', 'created_by_id', 'is_subscribed', 'is_online'])) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('first_name',128)->nullable()->after('image');
                $table->string('last_name',128)->nullable()->after('first_name');
                $table->string('customer_id',32)->nullable()->after('last_name');
                $table->date('date_of_birth')->nullable()->after('customer_id');
                $table->integer('gender')->default('0')->after('date_of_birth');
                $table->string('avg_rating',16)->default('1')->after('gender');
                $table->integer('total_reviews')->default('0')->after('avg_rating');
                $table->string('contact_no',16)->nullable()->after('total_reviews');
                $table->string('country_code',64)->nullable()->after('contact_no');
                $table->string('address',512)->nullable()->after('country_code');
                $table->string('district',64)->nullable()->after('address');
                $table->string('latitude',32)->nullable()->after('district');
                $table->string('longitude',32)->nullable()->after('latitude');
                $table->string('state',64)->nullable()->after('longitude');
                $table->string('city',64)->nullable()->after('state');
                $table->string('country',64)->nullable()->after('city');
                $table->string('zipcode',32)->nullable()->after('country');
                $table->string('language',32)->nullable()->after('zipcode');
                $table->string('profile_file',128)->nullable()->after('language');
                $table->string('referral_code',32)->default('0')->after('profile_file');
                $table->string('id_proof_file',128)->nullable()->after('referral_code');
                $table->string('license_file',128)->nullable()->after('id_proof_file');
                $table->integer('company_id')->nullable()->after('license_file');
                $table->integer('step')->default('0')->after('company_id');
                $table->string('otp', 16)->nullable()->after('step');
                $table->datetime('otp_timeout')->nullable()->after('otp');
                $table->integer('otp_verified')->default('0')->index()->after('otp_timeout');
                $table->integer('is_available')->default('1')->after('otp_verified');
                $table->integer('is_booked')->default('0')->after('is_available');
                $table->string('driver_number',64)->nullable()->after('is_booked');
                $table->integer('is_proof_verify')->default('0')->after('driver_number');
                $table->integer('is_license_verify')->default('0')->after('is_proof_verify');
                $table->integer('is_authorize_verify')->default('0')->after('is_license_verify');
                $table->integer('state_id')->default('1')->length(8)->index()->after('is_authorize_verify');
                $table->integer('type_id')->default('0')->length(8)->index()->after('state_id');
                $table->datetime('last_visit_time')->nullable()->after('type_id');
                $table->string('activation_key',128)->nullable()->after('last_visit_time');
                $table->integer('driver_type')->default('0')->length(8)->index()->after('activation_key');
                $table->datetime('last_password_change')->nullable()->after('driver_type');
                $table->integer('login_error_count')->nullable()->after('last_password_change');
                $table->integer('is_social_login')->default('0')->after('login_error_count');
                $table->string('timezone',64)->nullable()->after('is_social_login');
                $table->integer('created_by_id')->nullable()->after('timezone');
                $table->integer('is_subscribed')->default('0')->after('created_by_id');
                $table->integer('is_online')->default('0')->after('is_subscribed');
                $table->index(['email_verified_at']);
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
        if(Schema::hasColumns('users', ['first_name', 'last_name', 'customer_id', 'date_of_birth', 'gender', 'avg_rating', 'total_reviews', 'contact_no', 'country_code', 'address', 'district', 'latitude', 'longitude', 'state', 'city', 'country', 'zipcode', 'language', 'profile_file', 'referral_code', 'id_proof_file', 'license_file', 'company_id', 'step', 'otp', 'otp_timeout', 'otp_verified', 'is_available', 'is_booked', 'driver_number', 'driver_type', 'is_proof_verify', 'is_license_verify', 'is_authorize_verify', 'state_id', 'type_id', 'last_visit_time', 'activation_key', 'last_password_change', 'login_error_count', 'is_social_login', 'timezone', 'created_by_id', 'is_subscribed', 'is_online'])) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('first_name');
                $table->dropColumn('last_name');
                $table->dropColumn('customer_id');
                $table->dropColumn('date_of_birth');
                $table->dropColumn('gender');
                $table->dropColumn('avg_rating');
                $table->dropColumn('total_reviews');
                $table->dropColumn('contact_no');
                $table->dropColumn('country_code');
                $table->dropColumn('address');
                $table->dropColumn('district');
                $table->dropColumn('latitude');
                $table->dropColumn('longitude');
                $table->dropColumn('state');
                $table->dropColumn('city');
                $table->dropColumn('country');
                $table->dropColumn('zipcode');
                $table->dropColumn('language');
                $table->dropColumn('profile_file');
                $table->dropColumn('referral_code');
                $table->dropColumn('id_proof_file');
                $table->dropColumn('license_file');
                $table->dropColumn('company_id');
                $table->dropColumn('step');
                $table->dropColumn('otp');
                $table->dropColumn('otp_timeout');
                $table->dropColumn('otp_verified');
                $table->dropColumn('is_available');
                $table->dropColumn('is_booked');
                $table->dropColumn('driver_number');
                $table->dropColumn('is_proof_verify');
                $table->dropColumn('is_license_verify');
                $table->dropColumn('is_authorize_verify');
                $table->dropColumn('state_id');
                $table->dropColumn('type_id');
                $table->dropColumn('last_visit_time');
                $table->dropColumn('activation_key');
                $table->dropColumn('driver_type');
                $table->dropColumn('last_password_change');
                $table->dropColumn('login_error_count');
                $table->dropColumn('is_social_login');
                $table->dropColumn('timezone');
                $table->dropColumn('created_by_id');
                $table->dropColumn('is_subscribed');
                $table->dropColumn('is_online');
            });
        }
    }
}
