<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\BlogApiController;
use App\Http\Controllers\API\WarrLeadController;
use App\Http\Controllers\API\WarrServicePageApiController;
use App\Http\Controllers\MetaWebhookController;
use App\Http\Controllers\TwilioCallController;

Route::get('/blogs', [BlogApiController::class, 'index']);
Route::get('/blogs/{slug}', [BlogApiController::class, 'show']);

Route::post('/warr-leads', [WarrLeadController::class, 'store']);
Route::post('/v1/ads-lead', [WarrLeadController::class, 'adsLead']);

Route::get('/warr-service-pages', [WarrServicePageApiController::class, 'serviceSlugSitemap']);
Route::get('/warr-service-pages/sitemap', [WarrServicePageApiController::class, 'serviceSlugSitemap']);
Route::get('/warr-service-pages/all', [WarrServicePageApiController::class, 'index']);
Route::get('/warr-service-pages/{slug}', [WarrServicePageApiController::class, 'showBySlug']);

Route::get('/meta/webhook', [MetaWebhookController::class, 'verify']);
Route::post('/meta/webhook', [MetaWebhookController::class, 'handle']);
Route::get('/meta/fetch-leads/{formId}', [MetaWebhookController::class, 'fetchFormLeads']);

// Twilio Voice Webhook (TwiML) & Callbacks
Route::match(['GET', 'POST'], '/twilio/voice', [\App\Http\Controllers\PluginController::class, 'handleTwilioVoiceWebhook'])->name('api.twilio.voice');
Route::match(['GET', 'POST'], '/twilio/status-callback', [\App\Http\Controllers\PluginController::class, 'statusCallback'])->name('api.twilio.status.callback');
Route::match(['GET', 'POST'], '/twilio/recording-callback', [\App\Http\Controllers\PluginController::class, 'statusCallback'])->name('api.twilio.recording.callback');
Route::get('/twilio/recording/{id}', [\App\Http\Controllers\PluginController::class, 'streamRecording'])->name('api.twilio.recording');


