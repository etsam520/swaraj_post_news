<?php

use App\Http\Controllers\Admin\AdsController;
use App\Http\Controllers\Admin\Auth\AuthenticationController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\RoleAndPermissionController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VisualStoryController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')->name('admin.')->group(function(){
    Route::middleware('guest')->group(function () {
        Route::get('login', [AuthenticationController::class, 'create'])->name('login');
        Route::post('login', [AuthenticationController::class, 'store']);

        Route::get('forgot-password', [AuthenticationController::class, 'create'])->name('password.request');
        Route::post('forgot-password', [AuthenticationController::class, 'store'])->name('password.email');
        Route::get('reset-password/{token}', [AuthenticationController::class, 'create'])->name('password.reset');
        Route::post('reset-password', [AuthenticationController::class, 'store'])->name('password.update');
    });

    Route::middleware('admin_auth')->group(function () {
        // Route::post('register', [RegisteredUserController::class, 'store'])->name('administrator.register');
        Route::get('logout', [AuthenticationController::class, 'destroy'])->name('logout');

        Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

        Route::group(['prefix' => 'category', 'as' =>'category.'],function () {
            Route::get('/', [CategoryController::class, 'index'])->name('index');
            Route::get('/add', [CategoryController::class, 'add'])->name('add');
            Route::post('/store', [CategoryController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [CategoryController::class, 'update'])->name('update');
            Route::delete('/{id}', [CategoryController::class, 'destroy'])->name('destroy');
        });
        Route::group(['prefix' => 'city', 'as' =>'city.'],function () {
            Route::get('/{state_id}', [CityController::class, 'index'])->name('index');
            Route::get('/add', [CityController::class, 'add'])->name('add');
            Route::post('/store', [CityController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [CityController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [CityController::class, 'update'])->name('update');
            Route::delete('/{id}', [CityController::class, 'destroy'])->name('destroy');
        });

        Route::group(['prefix' => 'state', 'as' =>'state.'],function () {
            Route::get('/', [StateController::class, 'index'])->name('index');
            Route::get('/add', [StateController::class, 'add'])->name('add');
            Route::post('/store', [StateController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [StateController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [StateController::class, 'update'])->name('update');
            Route::delete('/{id}', [StateController::class, 'destroy'])->name('destroy');
        });

        Route::group(['prefix' => 'tags', 'as' =>'tags.'],function () {
            Route::get('/', [TagController::class, 'index'])->name('index');
            Route::get('/add', [TagController::class, 'add'])->name('add');
            Route::post('/store', [TagController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [TagController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [TagController::class, 'update'])->name('update');
            Route::delete('/{id}', [TagController::class, 'destroy'])->name('destroy');

        });

        Route::group(['prefix' => 'users', 'as' =>'user.'],function () {
                Route::get('/', [UserController::class, 'index'])->name('index');
            Route::get('/profile', [UserController::class, 'profile'])->name('profile');
            Route::post('/profile-update', [UserController::class, 'profileUpdate'])->name('profile.update');
            Route::get('/add', [UserController::class, 'add'])->name('add');
            Route::post('/store', [UserController::class, 'store'])->name('store');
            Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
            Route::put('/{user}', [UserController::class, 'update'])->name('update');
            Route::group(['prefix' => 'roles', 'as' =>'roles.'],function () {
                Route::get('/', [RoleAndPermissionController::class, 'index'])->name('index');
                Route::get('/add', [RoleAndPermissionController::class, 'add'])->name('add');
                Route::post('/store', [RoleAndPermissionController::class, 'store'])->name('store');
                Route::get('/edit/{id}', [RoleAndPermissionController::class, 'edit'])->name('edit');
                Route::put('/update/{id}', [RoleAndPermissionController::class, 'update'])->name('update');
                Route::delete('/{id}', [RoleAndPermissionController::class, 'destroy'])->name('destroy');
            });
            Route::group(['prefix' => 'permissions', 'as' =>'permissions.'],function () {
                Route::get('/', [RoleAndPermissionController::class, 'P_index'])->name('index');
                Route::get('/add', [RoleAndPermissionController::class, 'p_add'])->name('add');
                Route::post('/store', [RoleAndPermissionController::class, 'p_store'])->name('store');
                Route::delete('/permissions/{id}', [RoleAndPermissionController::class, 'p_destroy'])->name('destroy');
            });
        });

        Route::group(['prefix' => 'news', 'as' =>'news.'],function () {
            Route::get('/', [NewsController::class, 'index'])->name('index');
            Route::get('/draft', [NewsController::class, 'draft'])->name('draft');
            Route::get('/add', [NewsController::class, 'add'])->name('add');
            Route::post('/store', [NewsController::class, 'store'])->name('store');
            Route::get('status/{id}/{status}', [NewsController::class, 'changeStatus'])->name('change.status');
            Route::get('/{locale}/{slug}', [NewsController::class, 'show'])->name('show');
            Route::get('admin/news/{news}/edit', [NewsController::class, 'edit'])->name('edit');
            Route::put('admin/news/{news}', [NewsController::class, 'update'])->name('update');
            Route::delete('/admin/news/{id}', [NewsController::class, 'destroy'])->name('destroy');
        });

        Route::group(['prefix' => 'visual-stories', 'as' =>'visual-stories.'],function () {
            Route::get('/', [VisualStoryController::class, 'index'])->name('index');
            Route::get('/draft', [VisualStoryController::class, 'draft'])->name('draft');
            Route::get('/add', [VisualStoryController::class, 'add'])->name('add');
            Route::post('/store', [VisualStoryController::class, 'store'])->name('store');
            Route::get('/edit/{id}',[VisualStoryController::class, 'edit'])->name('edit');
            Route::put('/update/{id}',[VisualStoryController::class,'update'])->name('update');
            Route::delete('/destroy/{id}', [VisualStoryController::class, 'destroy'])->name('destroy');
            Route::get('/status/{id}/{status}', [VisualStoryController::class, 'changeStatus'])->name('change.status');
            Route::get('/show/{id}', [VisualStoryController::class, 'show'])->name('show');
        });

        Route::resource('ads',  AdsController::class)->names('ads');
    });
});
