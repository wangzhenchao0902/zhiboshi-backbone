<?php

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
use App\Http\Controllers\Api\ArticleController as Article;
use App\Http\Controllers\Api\WarrantyController as Warranty;
Route::group(['namespace' => 'Api'], function()
{
    // article
    Route::group(['prefix' => 'article'], function() {
        // list
        Route::get('/case', [Article::class, 'case']);
        Route::get('/news', [Article::class, 'news']);
        Route::get('/{id}', [Article::class, 'show'])->where('id', '[0-9]+');
        Route::get('/allIds', [Article::class, 'allIds']);
        Route::get('/about', [Article::class, 'about']);
        Route::get('/contact', [Article::class, 'contact']);
    });

    Route::get('/warranty', [Warranty::class, 'index']);
});

/*
|--------------------------------------------------------------------------
| Manager API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

use App\Http\Controllers\Manager\Auth\LoginController;
use App\Http\Controllers\Manager\UserController;
use App\Http\Controllers\Manager\ArticleController;
use App\Http\Controllers\Manager\ManagerController;
use App\Http\Controllers\Manager\UploadController;
use App\Http\Controllers\Manager\ProductController;
use App\Http\Controllers\Manager\WarrantyController;

Route::group(['prefix' => 'manager', 'middleware' => ['manager']], function() {
    // login
    Route::post('login', [LoginController::class, 'login']);

    // with auth
    Route::group(['middleware' => ['manager.auth']], function() {
        // userinfo
        Route::get('userinfo', [UserController::class, 'userinfo']);

        // logout
        Route::get('logout', [LoginController::class, 'logout']);

        Route::group(['prefix' => 'upload'], function()
        {
            Route::post('/', [UploadController::class, 'upload']);
            Route::get('/view', [UploadController::class, 'view']);
        });

        // article
        Route::group(['prefix' => 'article'], function() {
            // list
            Route::get('/', [ArticleController::class, 'index']);
            // store
            Route::post('/', [ArticleController::class, 'store']);
            // update
            Route::put('/{id}', [ArticleController::class, 'update'])->where('id', '[0-9]+');
            // delete
            Route::delete('/', [ArticleController::class, 'destroy']);
        });

        // manager
        Route::group(['prefix' => 'manager'], function() {
            // list
            Route::get('/', [ManagerController::class, 'index']);
            // store
            Route::post('/', [ManagerController::class, 'store']);
            // update
            Route::put('/{id}', [ManagerController::class, 'update'])->where('id', '[0-9]+');
            // delete
            Route::delete('/', [ManagerController::class, 'destroy']);
        });

        // product
        Route::group(['prefix' => 'product'], function() {
            // list
            Route::get('/', [ProductController::class, 'index']);
            // generate
            Route::post('/generate', [ProductController::class, 'generate']);
            // delete
            Route::post('/use/{id}', [ProductController::class, 'use'])->where('id', '[0-9]+');
        });

        // warranty
        Route::group(['prefix' => 'warranty'], function() {
            // list
            Route::get('/', [WarrantyController::class, 'index']);
            // generate
            Route::put('/{id}', [WarrantyController::class, 'update'])->where('id', '[0-9]+');
            //void
            Route::post('/void/{id}', [WarrantyController::class, 'void'])->where('id', '[0-9]+');
        });
    });

});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
