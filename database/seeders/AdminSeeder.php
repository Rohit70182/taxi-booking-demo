<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;
use App\Models\User;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

         DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@ozvid.in',
                'password' => Hash::make('admin@1924'),
                'role' => 0,
            ]
        ]);
    }
}
