<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\SignController;
use App\Http\Controllers\Api\V1\ReviewsController;

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

Route::post('auth/signup', [SignController::class, 'signUp']);
Route::post('auth/signin', [SignController::class, 'signIn']);
Route::middleware('auth:api')->group(function () {
    Route::prefix('reviews')->group(function () {
        Route::get('/', [ReviewsController::class, 'getReviews']); // просмотр пагинированного списка отзывов с ответами
        Route::post('/', [ReviewsController::class, 'addReview']); // добавление отзыва
    });
});
