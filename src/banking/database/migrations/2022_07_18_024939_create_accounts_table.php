<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string("owner")->nullable(false);
            $table->decimal("balance", 15, 2)->default(0)->nullable(false);
            $table->unsignedBigInteger('currency_id')->nullable(false);
            $table->foreign('currency_id')->references('id')->on('currencies')->onDelete('cascade');
            $table->dateTime("member_since")->default(DB::raw('CURRENT_TIMESTAMP'));
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
        Schema::dropIfExists('accounts');
    }
}
