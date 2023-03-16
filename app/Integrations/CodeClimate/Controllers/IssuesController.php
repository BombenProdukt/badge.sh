<?php

declare(strict_types=1);

namespace App\Integrations\CodeClimate\Controllers;

use App\Integrations\Actions\FormatNumber;
use App\Integrations\CodeClimate\Client;
use Illuminate\Routing\Controller;

final class IssuesController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $owner, string $repo): array
    {
        $response = $this->client->get($owner, $repo, 'snapshots');

        return [
            'label'       => 'issues',
            'status'      => FormatNumber::execute($response['meta']['issues_count']),
            'statusColor' => 'blue.600',
        ];
    }
}
