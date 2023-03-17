<?php

declare(strict_types=1);

namespace App\Integrations\GitLab\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\GitLab\Client;
use Carbon\Carbon;

final class LastCommitController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $owner, string $repo, ?string $ref = null): array
    {
        $response = $this->client->rest($owner, $repo, $ref ? "repository/commits?ref={$ref}" : 'repository/commits')->json('0');

        return [
            'label'       => 'last commit',
            'status'      => Carbon::parse($response['committed_date'])->diffForHumans(),
            'statusColor' => 'green.600',
        ];
    }
}
