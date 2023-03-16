<?php

declare(strict_types=1);

namespace App\Integrations\Packagist\Controllers;

use App\Integrations\Actions\FormatNumber;
use App\Integrations\Packagist\Client;
use Illuminate\Routing\Controller;

final class GitHubWatchersController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $vendor, string $package, ?string $channel = null): array
    {
        $packageMeta = $this->client->get($vendor, $package);

        return [
            'label'       => 'watchers',
            'status'      => FormatNumber::execute($packageMeta['github_watchers']),
            'statusColor' => 'green.600',
        ];
    }
}
