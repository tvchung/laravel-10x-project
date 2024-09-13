<?php

use App\Http\Controllers\Admins\AdminsController;
use App\Http\Controllers\Admins\CategoriesController;
use App\Http\Controllers\Admins\DashboardController;
use App\Http\Controllers\Admins\LoginController;
use App\Http\Controllers\Admins\NewsGroupController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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



Route::prefix('/admins')->namespace('\App\Http\Controllers\Admins')->group(function(){
    // đăng nhập hệ thống
    Route::get('/login',[LoginController::class,'login'])->name('admins.login');
    Route::post('/login',[LoginController::class,'loginPost'])->name('admins.loginPost');
    // xác thực đã đăng nhập (Authentication)
    Route::group(['middleware'=>['admin']],function(){
        Route::get('/',[DashboardController::class,'index'])->name('dashboard.index');
        Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard.index');
        Route::get('/admins',[AdminsController::class,'index'])->name('admins.index');
        //logout
        Route::get('/logout',[LoginController::class,'logout'])->name('admins.logout');

        // Categories
        Route::get('/category',[CategoriesController::class,'index'])->name('category.index');
        Route::get('/category/create',[CategoriesController::class,'create'])->name('category.create');
        Route::post('/category/create',[CategoriesController::class,'createSubmit'])->name('category.createSubmit');
        Route::get('/category/detail/{id}',[CategoriesController::class,'detail'])->name('category.detail');
        Route::get('/category/edit/{id}',[CategoriesController::class,'edit'])->name('category.edit');
        Route::post('/category/edit/{id}',[CategoriesController::class,'editSubmit'])->name('category.editSubmit');

        //news category (newsgroup)
        Route::get('/news-group',[NewsGroupController::class,'index'])->name('newsgroup.index');
        Route::get('/news-group/create',[NewsGroupController::class,'create'])->name('newsgroup.create');
        Route::get('/news-group/createSubmit',[NewsGroupController::class,'createSubmit'])->name('newsgroup.createSubmit-get');
        Route::post('/news-group/createSubmit',[NewsGroupController::class,'createSubmit'])->name('newsgroup.createSubmit');
        Route::get('/news-group/detail/{id}',[NewsGroupController::class,'detail'])->name('newsgroup.detail');
        Route::get('/news-group/edit/{id}',[NewsGroupController::class,'edit'])->name('newsgroup.edit');
        Route::post('/news-group/edit/{id}',[NewsGroupController::class,'editSubmit'])->name('newsgroup.editSubmit');
    });
    
});