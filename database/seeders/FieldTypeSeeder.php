<?php

namespace Database\Seeders;

use App\Models\FieldType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class FieldTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('field_types')->truncate();
        Schema::enableForeignKeyConstraints();
        // 1
        FieldType::insert([
            'name' => 'Vinyl'
        ]);
        // 2
        FieldType::insert([
            'name' => 'Rumput Sintetis'
        ]);
        // 3
        FieldType::insert([
            'name' => 'Semen'
        ]);
        // 4
        FieldType::insert([
            'name' => 'Parquette'
        ]);
        // 4
        FieldType::insert([
            'name' => 'Taraflex'
        ]);
        // 5
        FieldType::insert([
            'name' => 'Plastic Carpet'
        ]);
    }
}
