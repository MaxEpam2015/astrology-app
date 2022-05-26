<?php

use App\Http\Controllers\AstrologerController;
use App\Http\Controllers\OrderController;
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

Route::apiResource('astrologers', AstrologerController::class)->only([
    'index', 'show'
])->parameters([
    'astrologers' => 'uuid',
]);
Route::post('orders', [OrderController::class, 'store']);
Route::post('orders/checkout', [OrderController::class, 'checkout']);
