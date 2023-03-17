<?php

declare(strict_types=1);

namespace App\Integrations\Badgesize\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Badgesize\Client;

final class GitHubController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $compression, string $owner, string $repo, string $path): array
    {
        $response = $this->client->get($compression, "{$owner}/{$repo}/{$path}");

        return [
            'label'       => $compression === 'normal' ? 'size' : "{$compression} size",
            'status'      => $response['prettySize'],
            'statusColor' => $response['color'],
        ];
    }
}
