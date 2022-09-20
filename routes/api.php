<?php

use App\Http\Controllers\Article\ArticleController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'api','prefix' => 'auth'],function ($router) {
    Route::post('register', [AuthController::class,'register']);
    Route::post('login', [AuthController::class,'login']);
    Route::post('logout', [AuthController::class,'logout']);
    Route::post('refresh', [AuthController::class,'refresh']);
    Route::post('me', [AuthController::class,'me']);

});

Route::namespace('Article')->middleware('auth:api')->group(function(){
    Route::post('create-article',[ArticleController::class,'store']);
    Route::patch('update-article/{slug}',[ArticleController::class,'update']);
    Route::delete('delete-article/{slug}',[ArticleController::class,'destroy']);
});

Route::get('article/{slug}',[ArticleController::class,'show']);
Route::get('articles',[ArticleController::class,'index']);
