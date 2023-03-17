<?php

declare(strict_types=1);

namespace App\Integrations\Dependabot\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Dependabot\Client;

final class StatusController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $owner, string $repo, ?string $identifier = null): array
    {
        $response = $this->client->get($owner, $repo, $identifier);

        return [
            'label'       => 'Dependabot',
            'status'      => $response['status'],
            'statusColor' => $response['colour'],
        ];
    }
}
