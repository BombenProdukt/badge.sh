<?php

declare(strict_types=1);

namespace App\Integrations\GitLab\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\GitLab\Client;

final class ReleaseController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $owner, string $repo): array
    {
        $response = $this->client->rest($owner, $repo, 'releases')->json(0);

        if (empty($response)) {
            return [
                'label'       => 'release',
                'status'      => 'none',
                'statusColor' => 'yellow.600',
            ];
        }

        return [
            'label'       => 'release',
            'status'      => $response['name'],
            'statusColor' => 'blue.600',
        ];
    }
}
