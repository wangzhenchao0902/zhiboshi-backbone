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
use App\Http\Controllers\Api\AnliController as Anli;
use App\Http\Controllers\Api\WarrantyController as Warranty;
use App\Http\Controllers\Api\WarrantyChechuangController as WarrantyChechuang;
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
    Route::post('/warranty', [Warranty::class, 'store']);

    Route::get('/warrantychechuang', [WarrantyChechuang::class, 'index']);
    Route::post('/warrantychechuang', [WarrantyChechuang::class, 'store']);
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
use App\Http\Controllers\Manager\AnliController;
use App\Http\Controllers\Manager\ManagerController;
use App\Http\Controllers\Manager\UploadController;
use App\Http\Controllers\Manager\ProductController;
use App\Http\Controllers\Manager\ProductChechuangController;
use App\Http\Controllers\Manager\WarrantyController;
use App\Http\Controllers\Manager\WarrantyChechuangController;

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

        // anli
        Route::group(['prefix' => 'anli'], function() {
            // list
            Route::get('/', [AnliController::class, 'index']);
            // store
            Route::post('/', [AnliController::class, 'store']);
            // update
            Route::put('/{id}', [AnliController::class, 'update'])->where('id', '[0-9]+');
            // delete
            Route::delete('/', [AnliController::class, 'destroy']);
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
            // export
            Route::get('/export', [ProductController::class, 'export']);
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

        // productchechuang
        Route::group(['prefix' => 'productchechuang'], function() {
            // list
            Route::get('/', [ProductChechuangController::class, 'index']);
            // generate
            Route::post('/generate', [ProductChechuangController::class, 'generate']);
            // export
            Route::get('/export', [ProductChechuangController::class, 'export']);
            // delete
            Route::post('/use/{id}', [ProductChechuangController::class, 'use'])->where('id', '[0-9]+');
        });

        // warrantychechuang
        Route::group(['prefix' => 'warrantychechuang'], function() {
            // list
            Route::get('/', [WarrantyChechuangController::class, 'index']);
            // generate
            Route::put('/{id}', [WarrantyChechuangController::class, 'update'])->where('id', '[0-9]+');
            //void
            Route::post('/void/{id}', [WarrantyChechuangController::class, 'void'])->where('id', '[0-9]+');
        });
    });

});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
