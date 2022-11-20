<?php

use Illuminate\Support\Facades\Route;
// todo it,s very danger

if(!auth()->check()){
    login_user_test();
}

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('hello-hello',function(){
    return gettype();
});

Route::middleware(/*'auth:sanctum'*/[])->group( function () {
    # language (resource) Language
    Route::prefix('languages')->namespace('Language')->name('languages_')->group(function(){
        Route::get('/',[\App\Http\Controllers\Language\LanguageController::class,'index'])->name('index');
        Route::get('/{id}',[\App\Http\Controllers\Language\LanguageController::class,'show'])->name('show');
        Route::post('/',[\App\Http\Controllers\Language\LanguageController::class,'store'])->name('store');
        Route::put('/{id}',[\App\Http\Controllers\Language\LanguageController::class,'update'])->name('update');
        Route::delete('/{id}',[\App\Http\Controllers\Language\LanguageController::class,'destroy'])->name('destroy');
    });
});
