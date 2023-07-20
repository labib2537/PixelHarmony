<?php

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


Route::get('/user/upload', [WallpaperController::class, 'upload'])->name('upload_wallpaper');
Route::post('/user/store', [WallpaperController::class, 'store'])->name('store_wallpaper');
Route::get('/user/allWallpaper', [WallpaperController::class, 'fetchAllData'])->name('fetchAll_wallpaper');
Route::get('/user/all_wallpaper', [WallpaperController::class, 'display'])->name('display_wallpaper');
Route::get('user/search', [WallpaperController::class, 'search'])->name('search');
Route::get('user/searchWallpaper', [WallpaperController::class, 'searchWallpaper'])->name('search_wallpaper');
Route::post('/user/delete', [WallpaperController::class, 'delete'])->name('delete_wallpaper');
Route::post('/user/edit', [WallpaperController::class, 'edit'])->name('edit_wallpaper');
Route::post('/user/update', [WallpaperController::class, 'update'])->name('update_wallpaper');
