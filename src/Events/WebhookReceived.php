<?php

namespace Innoboxrr\OmniBilling\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class WebhookReceived
{
    use Dispatchable, SerializesModels;

    public string $processor;

    public string $eventType;

    public array $payload;

    public function __construct(string $processor, string $eventType, array $payload)
    {
        $this->processor = $processor;
        $this->eventType = $eventType;
        $this->payload = $payload;
    }
}
