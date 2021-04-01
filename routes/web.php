<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckAdmin;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();
//Route::get('/', 'App\Http\Controllers\Auth\LoginController@showLoginForm');

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group( function(){
//   Route::get('/stories', [App\Http\Controllers\StoriesController::class, 'index'])->name('stories.index'); 
//    Route::get('/stories/{story}', [App\Http\Controllers\StoriesController::class, 'show'])->name('stories.show'); 
    Route::resource('stories', 'App\Http\Controllers\StoriesController', ['names' =>['index' => 'stories.index', 'show' => 'stories.show', 'store' => 'stories.store']] );
});

Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.index');

Route::get('/story/{story:slug}', [App\Http\Controllers\DashboardController::class, 'show'])->name('dashboard.show');

Route::get('/email', [App\Http\Controllers\DashboardController::class, 'email'])->name('dashboard.email');

Route::namespace('Admin')->name('admin.stories.')->prefix('admin')->middleware(['auth', CheckAdmin::class])->group( function(){
Route::get('/deleted_stories', [App\Http\Controllers\Admin\StoriesController::class, 'index'])->name('index');
    
Route::put('/stories/restore/{id}', [App\Http\Controllers\Admin\StoriesController::class, 'restore'])->name('restore');
    
Route::delete('/stories/delete/{id}', [App\Http\Controllers\Admin\StoriesController::class, 'delete'])->name('delete');
Route::get('/stories/stats', [App\Http\Controllers\Admin\StoriesController::class, 'stats'])->name('stats');
});

Route::get('/image', function(){
    
    
    $imagePath = public_path('storage/flu.png');
    $writePath = public_path('storage/thumbnail.png');
    
    $img = Image::make($imagePath)->resize(255, 100);
    $img->save($writePath);
    return $img->response('jpg');
});

Route::get('/edit-profile', [App\Http\Controllers\ProfilesController::class, 'edit'])->name('profiles.edit');

Route::put('/edit-profile/{user}', [App\Http\Controllers\ProfilesController::class, 'update'])->name('profiles.update');




