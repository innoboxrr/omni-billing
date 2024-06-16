<?php

namespace Innoboxrr\OmniBilling\Common\Responses;

abstract class BaseCustomerResponse
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function __get($key)
    {
        return $this->data[$key] ?? null;
    }
}