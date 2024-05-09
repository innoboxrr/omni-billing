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

    protected string $successRedirect;

    protected string $cancelRedirect;

    protected string $errorRedirect;


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
        $this->successRedirect = url(Arr::get($config, 'redirects.success'));
        $this->cancelRedirect = url(Arr::get($config, 'redirects.cancel'));
        $this->errorRedirect = url(Arr::get($config, 'redirects.error'));
    }

    protected function getUrl(string $path)
    {
        return $this->baseUrl . $path;
    }

    protected function getSuccessRedirect(array $data)
    {
        $id = $data['id'] ?? '';
        $secret = encrypt($data['secret'] ?? '');
        return $this->successRedirect . '?id=' . $id . '&secret=' . $secret;
    }

}
