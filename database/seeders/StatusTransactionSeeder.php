<?php

namespace Database\Seeders;

use App\Models\StatusTransaction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class StatusTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('status_transactions')->truncate();
        Schema::enableForeignKeyConstraints();
        // 1
        StatusTransaction::insert([
            'name_user' => 'Not Yet Paid',
            'name_admin' => 'Not Yet Paid',
            'color' => 'bg-red-500'
        ]);
        // 2
        StatusTransaction::insert([
            'name_user' => 'Invalid proof of payment',
            'name_admin' => 'Invalid proof of payment',
            'color' => 'bg-red-500'
        ]);
        // 3
        StatusTransaction::insert([
            'name_user' => 'Waiting for DP payment validation',
            'name_admin' => 'Waiting for DP payment validation',
            'color' => 'bg-blue-500'
        ]);
        // 4
        StatusTransaction::insert([
            'name_user' => 'Waiting for payment validation',
            'name_admin' => 'Waiting for payment validation',
            'color' => 'bg-blue-500'
        ]);
        // 5
        StatusTransaction::insert([
            'name_user' => 'Successfully paid DP',
            'name_admin' => 'Already paid DP',
            'color' => 'bg-green-500'
        ]);
        // 6
        StatusTransaction::insert([
            'name_user' => 'Paid off',
            'name_admin' => 'Paid off',
            'color' => 'bg-green-500'
        ]);
    }
}
