<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CAuth;
use App\Http\Controllers\CCategory;
use App\Http\Controllers\CProduct;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//jwt
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('register', [CAuth::class, 'register']);
    Route::post('login', [CAuth::class, 'login']);
    Route::post('logout', [CAuth::class, 'logout']);
    Route::post('refresh', [CAuth::class, 'refresh']);
    Route::post('me', [CAuth::class, 'me']);
});


Route::middleware(['jwt.auth'])->group(function () {
    Route::post('category_product/{id}', [CCategory::class, 'update']);
    Route::post('product/{id}', [CProduct::class, 'update']);
    Route::apiResource('category_product', CCategory::class)->except('update');
    Route::apiResource('product', CProduct::class)->except('update');
});
