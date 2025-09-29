<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect(config('app.locale'));
});

Route::prefix('{locale}')->where(['locale' => '[a-zA-Z]{2}'])->group(function () {
    Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/contact', [\App\Http\Controllers\ContactController::class, 'index'])->name('contact');
    Route::get('/about', [\App\Http\Controllers\AboutController::class, 'index'])->name('about');
    Route::get('/service', [\App\Http\Controllers\AboutController::class, 'index'])->name('service');
    Route::get('/blog', [\App\Http\Controllers\AboutController::class, 'index'])->name('blog');


    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
    require __DIR__.'/auth.php';

});
