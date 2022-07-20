<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Site\HomeController as SiteController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\RegisterController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Site\PageController as Page;
use Symfony\Component\HttpKernel\Profiler\Profile;

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

Route::get('/',[SiteController::class,'index']);

Route::prefix('/painel')->group(function(){
    Route::get('/',[HomeController::class,'index'])->name('painel');

    /*LOGIN */
    Route::get('/login',[LoginController::class,'index'])->name('painel.login');
    Route::post('/login',[LoginController::class,'login']);

    /*LOGOUT */
    Route::post('/logout',[LoginController::class,'logout'])->name('painel.logout');

    /*REGISTRO */
    Route::get('/register',[RegisterController::class,'index'])->name('painel.register');
    Route::post('/register',[RegisterController::class,'register']);

    /*PERFIL DO USUÁRIO LOGADO */
    Route::get('/profile',[ProfileController::class,'index'])->name('profile');
    Route::put('/profilesave',[ProfileController::class,'save'])->name('profile.save');

    Route::get('/settings',[SettingController::class,'index'])->name('settings');
    Route::put('/settingsave',[SettingController::class,'save'])->name('settings.save');

    Route::resource('users',UserController::class);
    Route::resource('pages',PageController::class);
});

Route::fallback([Page::class,'fall']);
