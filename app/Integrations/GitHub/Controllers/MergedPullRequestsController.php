<?php

declare(strict_types=1);

namespace App\Integrations\GitHub\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\FormatNumber;
use App\Integrations\GitHub\Client;

final class MergedPullRequestsController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $owner, string $repo)
    {
        $result = $this->client->makeRepoQuery($owner, $repo, 'pullRequests(states:[MERGED]) { totalCount }');

        return [
            'label'       => 'merged PRs',
            'status'      => FormatNumber::execute($result['pullRequests']['totalCount']),
            'statusColor' => 'blue.600',
        ];
    }
}
