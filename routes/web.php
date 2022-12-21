<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrendPostController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {

    //admin
    Route::get('dashboard',[ProfileController::class,'index'])->name('dashboard');
    Route::post('admin/update',[ProfileController::class,'updateAdminAccount'])->name('admin#update');
    Route::get('admin/changePassword',[ProfileController::class,'changePassword'])->name('admin#changePassword');
    Route::post('admin/change',[ProfileController::class,'change'])->name('admin#change');

    //adminList
    Route::get('admin/list',[ListController::class,'index'])->name('admin#list');
    Route::get('admin/delete/{id}',[ListController::class,'deleteAccount'])->name('admin#accountDelete');

    //category
    Route::get('category',[CategoryController::class,'index'])->name('admin#category');
    Route::post('category/create',[CategoryController::class,'createCategory'])->name('admin#createCategory');
    Route::get('category/delete/{id}',[CategoryController::class,'deleteCategory'])->name('admin#deleteCategory');
    Route::get('category/editPage/{id}',[CategoryController::class,'editCategoryPage'])->name('admin#editCategoryPage');
    Route::post('category/update/{id}',[CategoryController::class,'categoryUpdate'])->name('admin#categoryUpdate');

    //post
    Route::get('post',[PostController::class,'index'])->name('admin#post');
    Route::post('post/createPost',[PostController::class,'createPost'])->name('admin#createPost');
    Route::get('post/deletePost/{id}',[PostController::class,'deletePost'])->name('admin#deletePost');
    Route::get('post/updatePostPage/{id}',[PostController::class,'editPage'])->name('admin#editPostPage');
    Route::post('admin/updatePost/{id}',[PostController::class,'updatePost'])->name('admin#updatePost');

    //trend post
    Route::get('trendPost',[TrendPostController::class,'index'])->name('admin#trendPost');
    Route::get('trendPost/details/{id}',[TrendPostController::class,'detailsPage'])->name('admin#detailsPage');
});


