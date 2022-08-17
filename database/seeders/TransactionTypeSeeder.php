<?php

namespace Database\Seeders;

use App\Models\TransactionType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TransactionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('transaction_types')->truncate();
        Schema::enableForeignKeyConstraints();


        TransactionType::insert([
            'name' => 'Down Payment'
        ]);
        TransactionType::insert([
            'name' => 'Paid Off'
        ]);
    }
}
