<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WallpaperController;
use App\Http\Controllers\NotificationController;

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
// Route::get('/', [WallpaperController::class, 'displayFront'])->name('display_front_wallpaper');
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile/show', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/edit', [ProfileController::class, 'edit2'])->name('profile.edit2');
    Route::post('/profile/update', [ProfileController::class, 'update2'])->name('profile.update2');
    Route::get('/profile/picture', [ProfileController::class, 'addProfileImage'])->name('profile.add_image');
    Route::post('/profile/picture_add', [ProfileController::class, 'pictureInsert'])->name('profile.pictureInsert');
    Route::get('/profile/picture_edit', [ProfileController::class, 'editProfileImage'])->name('profile.edit_image');
    Route::post('/profile/picture_update', [ProfileController::class, 'pictureUpdate'])->name('profile.pictureUpdate');
    Route::post('/profile/picture_remove', [ProfileController::class, 'pictureRemove'])->name('profile.imageRemove');
    Route::post('/profile/user', [ProfileController::class, 'userProfile'])->name('profile.user');
    Route::get('/profile/user/{id}', [ProfileController::class, 'showUser'])->name('profile.user2');
    




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
Route::get('/notify/update/{id}', [NotificationController::class, 'notifyUpdate'])->name('notify.click');   
Route::get('/notify/update2/{id}', [NotificationController::class, 'notifyUpdate2'])->name('notify.click2');  
Route::get('/notify/all', [NotificationController::class, 'allNotification'])->name('notification.all');   
    
})->middleware(['auth', 'verified']);

require __DIR__.'/auth.php';
