<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WallpaperController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


});
Route::get('/user', function () {
    return view('user.view');
})->middleware(['auth', 'verified'])->name('user');

Route::prefix('user')->group(function () {
   

//wallpaper for user all pages with group------------------------------------------------------
Route::get('/upload', [WallpaperController::class, 'upload'])->name('upload_wallpaper');
Route::post('/store', [WallpaperController::class, 'store'])->name('store_wallpaper');
Route::get('/allWallpaper', [WallpaperController::class, 'fetchAllData'])->name('fetchAll_wallpaper');
Route::get('/myWallpaper', [WallpaperController::class, 'fetchMyData'])->name('fetchMy_wallpaper');
Route::get('/all_wallpaper', [WallpaperController::class, 'display'])->name('display_wallpaper');
Route::get('/my_wallpaper', [WallpaperController::class, 'displayMyWallpaper'])->name('display_my_wallpaper');
Route::get('/search', [WallpaperController::class, 'search'])->name('search');
Route::get('/searchWallpaper', [WallpaperController::class, 'searchWallpaper'])->name('search_wallpaper');
Route::post('/delete', [WallpaperController::class, 'delete'])->name('delete_wallpaper');
Route::post('/edit', [WallpaperController::class, 'edit'])->name('edit_wallpaper');
Route::post('/update', [WallpaperController::class, 'update'])->name('update_wallpaper');
    
    
})->middleware(['auth', 'verified']);

require __DIR__.'/auth.php';
