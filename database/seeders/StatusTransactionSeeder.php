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
            'name_client' => 'Belum dibayar',
            'name_admin' => 'Belum membayar',
        ]);
        // 2
        StatusTransaction::insert([
            'name_client' => 'Bukti pembayaran tidak valid',
            'name_admin' => 'Bukti pembayaran tidak valid',
        ]);
        // 3
        StatusTransaction::insert([
            'name_client' => 'Menunggu validasi pembayaran DP',
            'name_admin' => 'Menunggu validasi pembayaran DP',
        ]);
        // 4
        StatusTransaction::insert([
            'name_client' => 'Menunggu validasi pembayaran pelunasan',
            'name_admin' => 'Menunggu validasi pembayaran pelunasan',
        ]);
        // 5
        StatusTransaction::insert([
            'name_client' => 'Berhasil membayar DP',
            'name_admin' => 'Sudah membayar DP',
        ]);
        // 6
        StatusTransaction::insert([
            'name_client' => 'Lunas',
            'name_admin' => 'Lunas',
        ]);
    }
}
