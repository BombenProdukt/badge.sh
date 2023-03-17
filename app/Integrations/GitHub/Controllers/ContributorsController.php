<?php

declare(strict_types=1);

namespace App\Integrations\GitHub\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\GitHub\Client;
use GrahamCampbell\GitHub\Facades\GitHub;

final class ContributorsController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $owner, string $repo): array
    {
        return [
            'label'       => 'contributors',
            'status'      => (string) count(GitHub::api('repo')->contributors($owner, $repo)),
            'statusColor' => 'blue.600',
        ];
    }
}
