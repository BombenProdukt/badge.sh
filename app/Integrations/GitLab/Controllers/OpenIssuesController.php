<?php

declare(strict_types=1);

namespace App\Integrations\GitLab\Controllers;

use App\Integrations\Actions\FormatNumber;
use App\Integrations\GitLab\Client;
use Illuminate\Routing\Controller;

final class OpenIssuesController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $owner, string $repo): array
    {
        $response = $this->client->graphql($owner, $repo, 'openIssuesCount')['openIssuesCount'];

        return [
            'label'       => 'open issues',
            'status'      => FormatNumber::execute($response),
            'statusColor' => $response === 0 ? 'green.600' : 'orange.600',
        ];
    }
}
