<?php

namespace Database\Seeders;

use App\Models\FutsalField;
use App\Models\FutsalImage;
use Illuminate\Database\Seeder;

class FutsalImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $fields = FutsalField::get();
       foreach ($fields as $field) {
            FutsalImage::create([
                'futsal_field_id' => $field->id,
                'img' => 'images/field/default.png'
            ]);
            
            FutsalImage::create([
                'futsal_field_id' => $field->id,
                'img' => 'images/field/default-2.png'
            ]);

            FutsalImage::create([
                'futsal_field_id' => $field->id,
                'img' => 'images/field/default.png'
            ]);
       }
    }
}
