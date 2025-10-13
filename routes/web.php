<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect(config('app.locale'));
});

Route::prefix('{locale}')->where(['locale' => '[a-zA-Z]{2}'])->group(function () {
    //Pages
    Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/contact', [\App\Http\Controllers\ContactController::class, 'index'])->name('contact');
    Route::get('/about', [\App\Http\Controllers\AboutController::class, 'index'])->name('about');


    //Auth routes
    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    //Contact routes
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

    //News pages for users
    Route::get('/news', [NewsController::class, 'index'])->name('news');
    Route::get('/news/{id}', [NewsController::class, 'show'])->name('news.show');

    //Brands page
    Route::get('/brands',[BrandController::class,'index'])->name('brands');

    //Services page
    Route::get('services',[ServiceController::class,'index'])->name('services');
    require __DIR__.'/auth.php';

});
