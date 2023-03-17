<?php

declare(strict_types=1);

namespace App\Integrations\Crates\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\FormatNumber;
use App\Integrations\Crates\Client;

final class LatestVersionDownloadsController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $package): array
    {
        return [
            'label'       => 'downloads',
            'status'      => FormatNumber::execute($this->client->get($package)['recent_downloads']).' latest version',
            'statusColor' => 'green.600',
        ];
    }
}
