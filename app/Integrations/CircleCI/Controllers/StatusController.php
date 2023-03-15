<?php

declare(strict_types=1);

namespace App\Integrations\CircleCI\Controllers;

use App\Integrations\CircleCI\Client;
use Illuminate\Routing\Controller;

final class StatusController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $vcs, string $owner, string $repo, ?string $branch = null): array
    {
        $status = $this->client->get($vcs, $owner, $repo, $branch)[0]['status'];

        return [
            'label'       => 'circleci',
            'status'      => str_replace('_', '', $status),
            'statusColor' => ['failed'  => 'red.600', 'success' => 'green.600'][$status] ?? 'grey.600',
        ];
    }
}
