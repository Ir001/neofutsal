<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        DB::table('users')->truncate();

        $this->call([
            UsersTableSeeder::class,
            ConfigurationSeeder::class,
            BallTypeSeeder::class,
            StatusTransactionSeeder::class,
            TransactionTypeSeeder::class,
            PaymentTypeSeeder::class,
            FieldTypeSeeder::class,
            FutsalFieldSeeder::class,
            FutsalImageSeeder::class,
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
