<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId("order_id")
                ->nullable()
                ->constrained("orders", "id")
                ->onUpdate("cascade")
                ->onDelete("cascade");
            $table->foreignId("transaction_type_id")
                ->nullable()
                ->constrained("transaction_types", "id")
                ->onUpdate("cascade")
                ->onDelete("set null");
            $table->foreignId("payment_type_id")
                ->nullable()
                ->constrained("payment_types", "id")
                ->onUpdate("cascade")
                ->onDelete("set null");
            $table->text("proof_file")->nullable();
            $table->float("code")->nullable();
            $table->double("amount")->nullable();
            $table->enum("is_valid", [0, 1])->nullable()->default(0); //0 = Tidak valid, 1 = Valid
            $table->timestamp("expired_payment")->nullable();
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
        Schema::dropIfExists('transactions');
    }
}
