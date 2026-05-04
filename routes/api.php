<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\BlogApiController;
use App\Http\Controllers\API\WarrLeadController;
use App\Http\Controllers\API\WarrServicePageApiController;

Route::get('/blogs', [BlogApiController::class, 'index']);
Route::get('/blogs/{slug}', [BlogApiController::class, 'show']);

Route::post('/warr-leads', [WarrLeadController::class, 'store']);

Route::get('/warr-service-pages', [WarrServicePageApiController::class, 'serviceSlugSitemap']);
Route::get('/warr-service-pages/{slug}', [WarrServicePageApiController::class, 'showBySlug']);