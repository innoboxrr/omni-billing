<?php

namespace Innoboxrr\OmniBilling\Common;

use Illuminate\Support\Arr;

abstract class Adapter
{

    protected array $config;

    protected string $baseUrl;

    protected string $secret;

    protected string $public;

    protected bool $testMode;


    public function __construct(array $config)
    {
        $this->setUp($config);
    }

    protected function setUp($config = [])
    {
        $this->config = $config;
        $this->baseUrl = Arr::get($config, 'base_url');
        $this->secret = Arr::get($config, 'secret');
        $this->public = Arr::get($config, 'public');
        $this->testMode = Arr::get($config, 'test_mode', false);
    }

    protected function getUrl(string $path)
    {
        return $this->baseUrl . $path;
    }

}
