<?php

declare(strict_types=1);

namespace App\Integrations\DavidDM\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\DavidDM\Client;

final class OptionalController extends AbstractController
{
    private array $statusInfo = [
        'insecure'      => ['insecure', 'red'],
        'outofdate'     => ['out of date', 'orange'],
        'notsouptodate' => ['up to date', 'yellow'],
        'uptodate'      => ['up to date', 'green'],
        'none'          => ['none', 'green'],
    ];

    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $owner, string $repo, string $path): array
    {
        $status = $this->client->get($owner, $repo, $path, 'optional-')['status'];

        return [
            'label'       => 'optionalDependencies',
            'status'      => $this->statusInfo[$status][0],
            'statusColor' => $this->statusInfo[$status][1],
        ];
    }
}
