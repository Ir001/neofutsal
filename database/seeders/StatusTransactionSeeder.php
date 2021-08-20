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
            'name_user' => 'Belum dibayar',
            'name_admin' => 'Belum membayar',
            'color' => 'bg-red-500'
        ]);
        // 2
        StatusTransaction::insert([
            'name_user' => 'Bukti pembayaran tidak valid',
            'name_admin' => 'Bukti pembayaran tidak valid',
            'color' => 'bg-red-500'
        ]);
        // 3
        StatusTransaction::insert([
            'name_user' => 'Menunggu validasi pembayaran DP',
            'name_admin' => 'Menunggu validasi pembayaran DP',
            'color' => 'bg-blue-500'
        ]);
        // 4
        StatusTransaction::insert([
            'name_user' => 'Menunggu validasi pembayaran pelunasan',
            'name_admin' => 'Menunggu validasi pembayaran pelunasan',
            'color' => 'bg-blue-500'
        ]);
        // 5
        StatusTransaction::insert([
            'name_user' => 'Berhasil membayar DP',
            'name_admin' => 'Sudah membayar DP',
            'color' => 'bg-green-500'
        ]);
        // 6
        StatusTransaction::insert([
            'name_user' => 'Lunas',
            'name_admin' => 'Lunas',
            'color' => 'bg-green-500'
        ]);
    }
}
