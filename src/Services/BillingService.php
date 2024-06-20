<?php

namespace Innoboxrr\OmniBilling\Services;

use Innoboxrr\OmniBilling\Contracts\CustomerInterface;
use Innoboxrr\OmniBilling\Contracts\PaymentInterface;
use Innoboxrr\OmniBilling\Contracts\SubscriptionInterface;

class BillingService 
{
    protected $gateway;

    protected $processor;

    public function __construct($gatewayKey, array $config = [])
    {   
        $redirects = (array) config('omnibilling.redirects');
        if(count($config) == 0) {
            $config = config("omnibilling.processors_config.$gatewayKey");
        }
        $config = [...$config, 'redirects' => $redirects];
        $this->gateway = app("omni-billing.$gatewayKey", [$config]);
        $this->processor = $gatewayKey;
    }

    public function getProcessor()
    {
        return $this->processor;
    }

    public function __call($method, $arguments)
    {
        if (method_exists($this->gateway, $method)) {
            return call_user_func_array([$this->gateway, $method], $arguments);
        }
        throw new \BadMethodCallException("Method [$method] does not exist.");
    }
}