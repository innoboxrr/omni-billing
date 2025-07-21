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

    protected function getUrl(string $path): string
    {
        return rtrim($this->baseUrl, '/') . '/' . ltrim($path, '/');
    }

    protected function appendParams(string $url, array $params): string
    {
        $separator = str_contains($url, '?') ? '&' : '?';
        return $url . $separator . http_build_query($params);
    }

    protected function getSuccessRedirect(array $data): string
    {
        return $this->appendParams($this->successRedirect, [
            'id' => $data['id'] ?? '',
            'secret' => encrypt($data['secret'] ?? ''),
        ]);
    }

    protected function getCancelRedirect(array $data): string
    {
        return $this->appendParams($this->cancelRedirect, [
            'id' => $data['id'] ?? '',
        ]);
    }

    protected function getErrorRedirect(array $data): string
    {
        return $this->appendParams($this->errorRedirect, [
            'id' => $data['id'] ?? '',
        ]);
    }
}
