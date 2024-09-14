<?php

use App\Http\Controllers\Api\PartsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/get-all-parts', [PartsController::class,'allParts']);
