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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->comment('اطلاعات مشترک کاربران');
            $table->bigInteger('user_creator')->nullable()->comment('شناسه کاربر ایجاد کننده');
            $table->string('first_name')->comment('نام');
            $table->string('last_name')->comment('نام خانوادگی');
            $table->string('username')->nullable()->comment('نام کاربری');
            $table->string('email')->unique()->comment('آدرس');
            $table->string('mobile')->nullable()->comment('شماره موبایل (برای لاگین)');
            $table->string('national_code')->nullable()->comment('کد ملی');
            $table->string('address')->nullable()->comment('آدرس');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->comment('رمز عبور');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
