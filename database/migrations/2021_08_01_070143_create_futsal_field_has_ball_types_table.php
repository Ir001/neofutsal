<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFutsalFieldHasBallTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('futsal_field_has_ball_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId("futsal_field_id")
                ->nullable()
                ->constrained("futsal_fields", "id")
                ->onUpdate("cascade")
                ->onDelete('cascade');
            $table->foreignId("ball_type_id")
                ->nullable()
                ->constrained("ball_types", "id")
                ->onUpdate("cascade")
                ->onDelete('cascade');
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
        Schema::dropIfExists('futsal_field_has_ball_types');
    }
}
