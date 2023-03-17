<?php

declare(strict_types=1);

namespace App\Integrations\CircleCI\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\CircleCI\Client;

final class StatusController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $vcs, string $owner, string $repo, ?string $branch = null): array
    {
        $status = $this->client->get($vcs, $owner, $repo, $branch)[0]['status'];

        return [
            'label'       => 'circleci',
            'status'      => str_replace('_', ' ', $status),
            'statusColor' => ['failed'  => 'red.600', 'success' => 'green.600'][$status] ?? 'grey.600',
        ];
    }
}
