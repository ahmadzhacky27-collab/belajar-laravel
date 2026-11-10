<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BelajarController;
use App\Http\Controllers\LoginController;

//
Route::get('belajar', [BelajarController::class, 'index']);
Route::get('tambah', [BelajarController::class, 'tambah'])->name('tambah');
Route::post('actionTambah', [BelajarController::class, 'actionTambah'])->name('actionTambah');
Route::get('kurang', [BelajarController::class, 'kurang'])->name('kurang');
Route::post('actionKurang', [BelajarController::class, 'actionKurang'])->name('actionKurang');
Route::get('kali', [BelajarController::class, 'kali'])->name('kali');
Route::post('actionKali', [BelajarController::class, 'actionKali'])->name('actionKali');
Route::get('bagi', [BelajarController::class, 'bagi'])->name('bagi');

// prefix admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [\App\Http\Controllers\LoginController::class, 'login']);
    Route::post('/actionLogin', [\App\Http\Controllers\LoginController::class, 'actionLogin'])->name('actionLogin');

    Route::middleware(['auth'])->group(function () {
        Route::resource('dashboard', \App\Http\Controllers\DashboardController::class);
        Route::resource('user', \App\Http\Controllers\UserController::class);
        Route::resource('category', \App\Http\Controllers\CategoryController::class);
        Route::resource('product', \App\Http\Controllers\ProductController::class);
        Route::resource('category_blog', \App\Http\Controllers\CategoryBlogController::class);
        Route::resource('blog', \App\Http\Controllers\BlogController::class);

        Route::get('/settings', [\App\Http\Controllers\SettingController::class, 'index'])->name('settings');
        Route::post('/settings', [\App\Http\Controllers\SettingController::class, 'update'])->name('settings.update');

        Route::post('logout', [\App\Http\Controllers\LoginController::class, 'logout'])->name('logout');
    });
});

// Halaman Publik (Frontend)
Route::get('/', [\App\Http\Controllers\HomeController::class, 'index']);
Route::get('/category/{slug}', [\App\Http\Controllers\CatalogController::class, 'category'])->name('category.show');
Route::get('product', [\App\Http\Controllers\CatalogController::class, 'listing'])->name('product.index');
Route::get('/product/{slug}', [\App\Http\Controllers\CatalogController::class, 'product'])->name('product.show');

Route::get('faq', [\App\Http\Controllers\PageController::class, 'faq'])->name('faq.index');
Route::get('contact', [\App\Http\Controllers\PageController::class, 'contact'])->name('contact.index');
Route::get('blog', [\App\Http\Controllers\PageController::class, 'blog'])->name('blog.index');
Route::get('blog/{slug}', [\App\Http\Controllers\PageController::class, 'showBlog'])->name('blog.show');
