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
        Schema::create('user_financial_accounts', function (Blueprint $table) {
            $table->id();
            $table->comment('اطلاعات مالی کاربران');
            $table->bigInteger('user_creator')->nullable()->comment('شناسه کاربر ایجاد کننده');
            $table->string('card_number')->comment('شماره کارت');
            $table->foreignId('user_id')->comment('شناسه کاربر')->constrained();
            $table->foreignId('bank_id')->comment('شناسه بانک')->constrained();
            $table->string('sheba_number')->comment('شماره شباء');
            $table->tinyInteger('state')->comment('وضعیت حساب');
            $table->timestamp('expired_at')->nullable()->comment('تاریخ انقضا');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_financial_accounts');
    }
};
