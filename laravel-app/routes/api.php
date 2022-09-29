<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyController;

Route::get("/sort_string/{myStr}", [MyController::class, "sortedString"]);

Route::get("/place_value/{num}", [MyController::class, "placeValue"]);
