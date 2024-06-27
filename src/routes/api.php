<?php

use App\Http\Controllers\ExplorerController;
use App\Http\Controllers\ItemController;

Route::apiResource('explorers', ExplorerController::class);
Route::put('explorers/{id}/location', [ExplorerController::class, 'updateLocation']);
Route::post('explorers/{id}/items', [ExplorerController::class, 'addItem']);
Route::post('/items', [ItemController::class, 'store']);
Route::post('explorers/trade', [ExplorerController::class, 'tradeItems']);
Route::get('/explorers/{id}/history', [ExplorerController::class, 'locationHistory']);
