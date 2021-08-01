<?php

namespace Database\Seeders;

use App\Models\PaymentType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PaymentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('payment_types')->truncate();
        Schema::enableForeignKeyConstraints();

        PaymentType::insert([
            'bank_name' => 'BRI Bank Rakyat Indonesia',
            'bank_code' => '002',
            'holder_name' => 'IRWAN ANTONIO',
            'bank_account' => '683701023081539',
            'instruction' => '
            <b>Tata Cara Transfer Melalui BRImo (BRI Mobile Banking)</b>
            <ul>
                <li>Buka aplikasi, kemudian pilih menu Mobile Banking BRI.</li>
                <li>Untuk mengirim uang, tap menu Transfer.</li>
                <li>Untuk transfer ke sesama rekening BRI, tap menu Sesama BRI.</li>
                <li>Pada halaman baru, masukkan nomor rekening BRI yang dituju.</li>
                <li>Masukkan jumlah transfer yang akan dikirim.</li>
            </ul>
            '
        ]);
        PaymentType::insert([
            'bank_name' => 'Bank Mandiri',
            'bank_code' => '008',
            'holder_name' => 'IRWAN ANTONIO',
            'bank_account' => '1290012290850',
            'instruction' => '
            <b>Tata Cara Transfer Melalui Livin by Mandiri</b>
            <ul>
                <li>Login Livin dengan Username dan Password Anda.</li>
                <li>Tap di menu Transfer.</li>
                <li>Pilih jenis transfer Ke Rekening Mandiri</li>
                <li>Tentukan Rekening Sumber yang akan anda pakai.</li>
                <li>Isi Nomor Rekening Tujuan transfer dan Jumlah transfer. Anda juga bisa menjadwalkan transfer pada pilihan Kapan?.</li>
                <li>Pastikan informasi bayar sesuai lalu tekan Kirim dan masukkan MPIN.</li>
            </ul>
            '
        ]);
    }
}
