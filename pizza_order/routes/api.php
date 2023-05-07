<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RouteController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//Get
Route::get('product/list',[RouteController::class,'productList']);
Route::get('category/list',[RouteController::class,'categoryList']);

//Post
Route::post('create/category',[RouteController::class,'categoryCreate']);
Route::post('create/contact',[RouteController::class,'createContact']);

Route::get('delete/category/{id}',[RouteController::class,'deleteCategory']);

Route::get('category/details/{id}',[RouteController::class,'categoryDetails']);
Route::post('category/update',[RouteController::class,'categoryUpdate']);



