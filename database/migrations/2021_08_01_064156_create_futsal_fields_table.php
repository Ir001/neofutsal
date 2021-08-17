<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFutsalFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('futsal_fields', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable();
            $table->foreignId("field_type_id")
                ->nullable()
                ->constrained("field_types", "id")
                ->onUpdate("cascade")
                ->onDelete("set null");
            $table->double("price")->nullable()->default(0);
            $table->float("width")->nullable()->default(25);
            $table->float("height")->nullable()->default(16);
            $table->text('img')
                ->nullable();
            $table->enum('is_available', [0, 1])->nullable()->default(1);
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
        Schema::dropIfExists('futsal_fields');
    }
}
