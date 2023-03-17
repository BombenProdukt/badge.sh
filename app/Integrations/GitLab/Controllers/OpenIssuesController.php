<?php

declare(strict_types=1);

namespace App\Integrations\GitLab\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\FormatNumber;
use App\Integrations\GitLab\Client;

final class OpenIssuesController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $owner, string $repo): array
    {
        $response = $this->client->graphql($owner, $repo, 'openIssuesCount')['openIssuesCount'];

        return [
            'label'       => 'open issues',
            'status'      => FormatNumber::execute($response),
            'statusColor' => $response === 0 ? 'green.600' : 'orange.600',
        ];
    }
}
