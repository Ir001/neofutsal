<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@neofutsal.id',
            'email_verified_at' => now(),
            'password' => Hash::make('neofutsal'),
            'created_at' => now(),
            'updated_at' => now(),
            'is_admin' => '1'
        ]);
        DB::table('users')->insert([
            'name' => 'User',
            'email' => 'user@neofutsal.id',
            'email_verified_at' => now(),
            'password' => Hash::make('neofutsal'),
            'created_at' => now(),
            'updated_at' => now(),
            'is_admin' => '0'
        ]);
    }
}
