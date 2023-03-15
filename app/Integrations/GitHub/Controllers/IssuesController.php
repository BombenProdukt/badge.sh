<?php

declare(strict_types=1);

namespace App\Integrations\GitHub\Controllers;

use App\Integrations\Actions\FormatNumber;
use App\Integrations\GitHub\Client;
use Illuminate\Routing\Controller;

final class IssuesController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $owner, string $repo): array
    {
        $result = $this->client->makeRepoQuery($owner, $repo, 'issues { totalCount }');

        return [
            'label'       => 'issues',
            'status'      => FormatNumber::execute($result['issues']['totalCount']),
            'statusColor' => 'blue.600',
        ];
    }
}
