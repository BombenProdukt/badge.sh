<?php

declare(strict_types=1);

namespace App\Integrations\GitLab\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\FormatNumber;
use App\Integrations\GitLab\Client;

final class TagsController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $owner, string $repo): array
    {
        $response = $this->client->rest($owner, $repo, 'repository/tags');

        return [
            'label'       => 'tags',
            'status'      => FormatNumber::execute((int) $response->header('x-total')),
            'statusColor' => 'blue.600',
        ];
    }
}
