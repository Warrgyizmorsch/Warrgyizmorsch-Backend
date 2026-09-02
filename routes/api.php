<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\BlogApiController;
use App\Http\Controllers\API\WarrLeadController;
use App\Http\Controllers\API\WarrServicePageApiController;
use App\Http\Controllers\MetaWebhookController;

Route::get('/blogs', [BlogApiController::class, 'index']);
Route::get('/blogs/{slug}', [BlogApiController::class, 'show']);

Route::post('/warr-leads', [WarrLeadController::class, 'store']);

Route::get('/warr-service-pages', [WarrServicePageApiController::class, 'serviceSlugSitemap']);
Route::get('/warr-service-pages/sitemap', [WarrServicePageApiController::class, 'serviceSlugSitemap']);
Route::get('/warr-service-pages/all', [WarrServicePageApiController::class, 'index']);
Route::get('/warr-service-pages/{slug}', [WarrServicePageApiController::class, 'showBySlug']);

Route::get('/meta/webhook', [MetaWebhookController::class, 'verify']);
Route::post('/meta/webhook', [MetaWebhookController::class, 'handle']);
Route::get('/meta/fetch-leads/{formId}', [MetaWebhookController::class, 'fetchFormLeads']);
