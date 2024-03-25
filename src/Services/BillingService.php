<?php

namespace Innoboxrr\OmniBilling\Services;

use Innoboxrr\OmniBilling\Contracts\CustomerInterface;
use Innoboxrr\OmniBilling\Contracts\PaymentInterface;
use Innoboxrr\OmniBilling\Contracts\SubscriptionInterface;

class BillingService 
{
    protected $gateway;

    public function __construct($gatewayKey, array $config = [])
    {
        $this->gateway = app("omni-billing.$gatewayKey", [$config]);
    }

    public function __call($method, $arguments)
    {
        if (method_exists($this->gateway, $method)) {
            return call_user_func_array([$this->gateway, $method], $arguments);
        }
        throw new \BadMethodCallException("Method [$method] does not exist.");
    }
}