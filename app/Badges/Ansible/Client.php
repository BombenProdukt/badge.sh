<?php

declare(strict_types=1);

namespace App\Badges\Ansible;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

final class Client
{
    private PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::baseUrl('https://galaxy.ansible.com/api')->throw();
    }

    public function collections(string $collectionId): array
    {
        return $this->client->get("v2/collections/{$collectionId}")->json();
    }

    public function content(string $projectId): array
    {
        return $this->client->get("v1/content/{$projectId}")->json();
    }

    public function roles(string $roleId): array
    {
        return $this->client->get("v1/roles/{$roleId}")->json();
    }
}
