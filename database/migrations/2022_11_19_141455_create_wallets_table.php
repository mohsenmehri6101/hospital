<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('state')->comment('وضعیت کیف پول');
            $table->foreignId('user_id')->comment('شناسه کاربر')->constrained();
            $table->bigInteger('user_creator')->nullable()->comment('شناسه کاربر ایجاد کننده');
            $table->decimal('sum_balance');
            $table->decimal('block_balance');
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
        Schema::dropIfExists('wallets');
    }

};
