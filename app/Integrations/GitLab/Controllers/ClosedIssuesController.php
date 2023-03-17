<?php

declare(strict_types=1);

namespace App\Integrations\GitLab\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\FormatNumber;
use App\Integrations\GitLab\Client;

final class ClosedIssuesController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $owner, string $repo): array
    {
        $response = $this->client->graphql($owner, $repo, 'issues(state:closed){ count }')['issues']['count'];

        return [
            'label'       => 'closed issues',
            'status'      => FormatNumber::execute($response),
            'statusColor' => 'blue.600',
        ];
    }
}
