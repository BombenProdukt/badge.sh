<?php

declare(strict_types=1);

namespace App\Badges\Concerns;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

trait HasRequest
{
    protected Request $request;
    protected array $requestData = [];

    public function setRequest(Request $request): void
    {
        $this->request = $request;
    }

    public function getRequestData(string $key, mixed $default = null): mixed
    {
        return Arr::get($this->requestData, $key, $default);
    }

    public function setRequestData(array $data): void
    {
        $this->requestData = $data;
    }
}
