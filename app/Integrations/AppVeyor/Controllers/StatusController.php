<?php

declare(strict_types=1);

namespace App\Integrations\AppVeyor\Controllers;

use App\Integrations\AppVeyor\Client;
use Illuminate\Routing\Controller;

final class StatusController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $account, string $project, ?string $branch = null): array
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
