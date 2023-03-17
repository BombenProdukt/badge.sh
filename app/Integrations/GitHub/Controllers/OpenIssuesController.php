<?php

declare(strict_types=1);

namespace App\Integrations\GitHub\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\FormatNumber;
use App\Integrations\GitHub\Client;

final class OpenIssuesController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $owner, string $repo): array
    {
        $result = $this->client->makeRepoQuery($owner, $repo, 'issues(states:[OPEN]) { totalCount }');

        return [
            'label'       => 'open issues',
            'status'      => FormatNumber::execute($result['issues']['totalCount']),
            'statusColor' => $result['issues']['totalCount'] === 0 ? 'green.600' : 'orange.600',
        ];
    }
}
