<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyController;

Route::post("/sort_string", [MyController::class, "sortedString"]);

Route::post("/place_value", [MyController::class, "placeValue"]);
