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
        Schema::create('translators', function (Blueprint $table) {
            $table->id();
            $table->comment('مترجم');
            $table->foreignId('user_id')->comment('شناسه کاربر')->constrained();
            $table->foreignId('language_id')->comment('شناسه کاربر')->constrained();
            $table->bigInteger('user_creator')->nullable()->comment('شناسه کاربر ایجاد کننده');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('language_translator', function (Blueprint $table) {
            $table->foreignId('language_id')->comment('شناسه زبان')->constrained();
            $table->foreignId('translator_id')->comment('شناسه مترجم')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('language_translator');
        Schema::dropIfExists('translators');
    }
};
