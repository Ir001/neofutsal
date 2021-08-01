<?php

namespace Database\Seeders;

use App\Models\BallType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class BallTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('ball_types')->truncate();
        Schema::enableForeignKeyConstraints();
        BallType::insert([
            'name' => 'Kecil',
            'amount' => 10,
        ]);
        BallType::insert([
            'name' => 'Besar',
            'amount' => 6,
        ]);
        BallType::insert([
            'name' => 'Sport',
            'amount' => 3,
        ]);
        BallType::insert([
            'name' => 'Sedang',
            'amount' => 10,
            'is_available' => '0'
        ]);
    }
}
