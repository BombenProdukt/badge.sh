<?php

declare(strict_types=1);

namespace App\Integrations\DavidDM\Controllers;

use App\Integrations\DavidDM\Client;
use Illuminate\Routing\Controller;

final class PeerController extends Controller
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

    public function __invoke(string $owner, string $repo, string $path): array
    {
        $status = $this->client->get($owner, $repo, $path, 'peer-')['status'];

        return [
            'label'       => 'peerDependencies',
            'status'      => $this->statusInfo[$status][0],
            'statusColor' => $this->statusInfo[$status][1],
        ];
    }
}