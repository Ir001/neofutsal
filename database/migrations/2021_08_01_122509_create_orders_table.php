<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")
                ->nullable()
                ->constrained("users", "id")
                ->onUpdate("cascade")
                ->onDelete("set null");
            $table->foreignId("futsal_field_id")
                ->nullable()
                ->constrained("futsal_fields", "id")
                ->onUpdate("cascade")
                ->onDelete("set null");
            $table->foreignId("status_transaction_id")
                ->nullable()
                ->default(1)
                ->constrained("status_transactions", "id")
                ->onUpdate("cascade")
                ->onDelete("set null");
            $table->integer("hours")->nullable()->default(1);
            $table->double("price")->nullable()->default(0);
            $table->date("play_date")->nullable();
            $table->dateTime("start_at")->nullable();
            $table->dateTime("end_at")->nullable();
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
        Schema::dropIfExists('orders');
    }
}
