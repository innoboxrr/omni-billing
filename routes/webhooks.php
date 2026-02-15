<?php

use Illuminate\Support\Facades\Route;
use Innoboxrr\OmniBilling\Http\Controllers\WebhookController;

Route::post('webhooks/{processor}', [WebhookController::class, 'handle']);
