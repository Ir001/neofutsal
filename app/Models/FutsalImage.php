<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class FutsalImage extends Model
{
    use HasFactory;

    protected $table = 'futsal_images';

    protected $fillable = ['futsal_field_id', 'img'];

    //Helper
    public static function uploadDetailImg($files, $futsalFieldId){
        try{
           foreach ($files as $file) {
                $ext = $file->extension();
                $filename = Str::random(10).".".$ext;
                $fullPath = "futsal-field/detail-{$filename}";
                $file->storeAs("public",$fullPath);
                self::create([
                    'futsal_field_id' => $futsalFieldId,
                    'img' => "storage/$fullPath",
                ]);
            }
            return true;
        }catch(Exception $e){
            return false;
        }
    }
}
