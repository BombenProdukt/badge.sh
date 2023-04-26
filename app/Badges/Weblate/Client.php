<?php

declare(strict_types=1);

namespace App\Badges\Weblate;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://hosted.weblate.org/api')->throw();
    }

    public function entity(string $type): array
    {
        return $this->client->get("{$type}/")->json();
    }

    public function component(string $project, string $component): array
    {
        return $this->client->get("components/{$project}/{$component}/")->json();
    }

    public function project(string $project): array
    {
        return $this->client->get("projects/{$project}/statistics/")->json();
    }

    public function user(string $user): array
    {
        return $this->client->get("users/{$user}/statistics/")->json();
    }
}
