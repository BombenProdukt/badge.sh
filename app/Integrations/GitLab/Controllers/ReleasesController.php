<?php

declare(strict_types=1);

namespace App\Integrations\GitLab\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\FormatNumber;
use App\Integrations\GitLab\Client;

final class ReleasesController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $owner, string $repo): array
    {
        $response = $this->client->rest($owner, $repo, 'releases');

        return [
            'label'       => 'releases',
            'status'      => FormatNumber::execute((int) $response->header('x-total')),
            'statusColor' => 'blue.600',
        ];
    }
}
