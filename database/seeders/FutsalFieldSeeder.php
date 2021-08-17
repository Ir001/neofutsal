<?php

namespace Database\Seeders;

use App\Models\FutsalField;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class FutsalFieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('futsal_fields')->truncate();
        Schema::enableForeignKeyConstraints();
        FutsalField::insert([
            'name' => 'Neofutsal Lite',
            'field_type_id' => 1, //Vynl
            'price' => 50000,
            'img' => 'images/field/default.png'
        ]);
        FutsalField::insert([
            'name' => 'Neofutsal +',
            'field_type_id' => 2, // Sintetis
            'price' => 64000,
            'img' => 'images/field/default-2.png'
        ]);
        FutsalField::insert([
            'name' => 'Neofutsal Sport',
            'field_type_id' => 2, //Sintetis
            'price' => 64000,
            'img' => 'images/field/default.png'
        ]);
    }
}
