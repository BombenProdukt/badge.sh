<?php

declare(strict_types=1);

namespace App\Integrations\NPM\Controllers;

use App\Integrations\NPM\Client;
use Illuminate\Routing\Controller;

final class VersionController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $package, string $tag = 'latest'): array
    {
        return [
            'label'       => $tag === 'latest' ? 'npm' : "npm@{$tag}",
            'status'      => $this->client->unpkg("{$package}@{$tag}/package.json")['version'],
            'statusColor' => 'green.600',
        ];
    }
}
