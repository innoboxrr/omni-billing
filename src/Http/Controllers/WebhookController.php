<?php

namespace Innoboxrr\OmniBilling\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Innoboxrr\OmniBilling\Contracts\WebhookInterface;
use Innoboxrr\OmniBilling\Events\WebhookReceived;

class WebhookController extends Controller
{
    public function handle(Request $request, string $processor)
    {
        $configKey = "omnibilling.processors_config.{$processor}";
        $config = config($configKey);

        if (!$config) {
            return response()->json(['error' => 'Unknown processor'], 404);
        }

        $redirects = (array) config('omnibilling.redirects');
        $config = array_merge($config, ['redirects' => $redirects]);

        if (!app()->bound("omni-billing.{$processor}")) {
            return response()->json(['error' => 'Processor not registered'], 404);
        }

        $adapter = app("omni-billing.{$processor}", [$config]);

        if (!$adapter instanceof WebhookInterface) {
            return response()->json(['error' => 'Processor does not support webhooks'], 404);
        }

        try {
            $result = $adapter->verifyWebhook($request);
        } catch (\Exception $e) {
            Log::warning("Webhook signature verification failed for [{$processor}]: {$e->getMessage()}");
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        $eventType = $result['eventType'] ?? 'unknown';
        $payload = $result['payload'] ?? [];

        WebhookReceived::dispatch($processor, $eventType, $payload);

        Log::info("Webhook received [{$processor}]: {$eventType}");

        return response()->json(['status' => 'ok'], 200);
    }
}
