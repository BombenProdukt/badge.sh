<?php

declare(strict_types=1);

namespace App\Integrations\GitLab\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\FormatNumber;
use App\Integrations\GitLab\Client;

final class IssuesController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $owner, string $repo): array
    {
        $response = $this->client->graphql($owner, $repo, 'issues{ count }')['issues']['count'];

        return [
            'label'       => 'issues',
            'status'      => FormatNumber::execute($response),
            'statusColor' => 'blue.600',
        ];
    }
}
