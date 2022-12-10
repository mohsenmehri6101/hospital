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
        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->comment('زبان ها');
            $table->tinyInteger('state')->default(\App\Models\Language::ActiveState)->comment('وضعیت زبان');
            $table->string('name_persian')->nullable()->comment('نام فارسی');
            $table->string('name_english')->nullable()->comment('نام انگلیسی');
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
        Schema::dropIfExists('languages');
    }
};
