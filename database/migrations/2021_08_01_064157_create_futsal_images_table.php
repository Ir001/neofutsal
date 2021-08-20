<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFutsalImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('futsal_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('futsal_field_id')
                ->nullable()
                ->constrained('futsal_fields')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->text('img')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('futsal_images');
    }
}
