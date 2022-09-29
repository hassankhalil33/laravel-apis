<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyController;

Route::get("/", [MyController::class, "sortedString"]);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
