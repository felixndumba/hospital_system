<?php
use App\Http\Controllers\API\UserController;
use Illuminate\Support\Facades\Route;


Route::prefix('api')->group(function () {
   // Debug route to verify this group is working
   Route::get('/', function () {
       return response()->json(['message' => 'API backend route loaded']);
   });


   // Your API resource routes here
   Route::apiResource('users', UserController::class);
});
