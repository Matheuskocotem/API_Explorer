<?php

use App\Http\Controllers\ExplorerController;
use App\Http\Controllers\ItemController;

Route::apiResource('explorers', ExplorerController::class);
Route::post('explorers/{id}/location', [ExplorerController::class, 'updateLocation']);
Route::post('explorers/{id}/items', [ExplorerController::class, 'addItem']);
Route::post('explorers/trade', [ExplorerController::class, 'tradeItems']);
