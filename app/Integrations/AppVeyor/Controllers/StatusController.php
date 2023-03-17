<?php

declare(strict_types=1);

namespace App\Integrations\AppVeyor\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\AppVeyor\Client;

final class StatusController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $account, string $project, ?string $branch = null): array
    {
        $branch = $branch ? "/branch/{$branch}" : '';
        $status = $this->client->get($account, $project, $branch)['build']['status'];

        return [
            'label'       => 'appveyor',
            'status'      => $status,
            'statusColor' => $status === 'success' ? 'green.600' : 'red.600',
        ];
    }
}
