<?php

namespace Innoboxrr\OmniBilling\Contracts;

use Illuminate\Http\Request;

interface WebhookInterface
{
    /**
     * Verify the webhook signature and return the parsed event.
     *
     * @param  Request  $request
     * @return array  ['eventType' => string, 'payload' => array]
     *
     * @throws \Exception  If signature verification fails
     */
    public function verifyWebhook(Request $request): array;
}
