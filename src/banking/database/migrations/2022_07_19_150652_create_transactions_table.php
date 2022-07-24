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
            $table->unsignedBigInteger('from_account_id')->nullable(false);
            $table->foreign('from_account_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->unsignedBigInteger('to_account_id')->nullable(false);
            $table->foreign('to_account_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->unsignedBigInteger('currency_id')->nullable(false);
            $table->foreign('currency_id')->references('id')->on('currencies')->onDelete('cascade');
            $table->decimal('amount', 15, 2)->nullable(false);
            $table->dateTime('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('transactions');
    }
}
