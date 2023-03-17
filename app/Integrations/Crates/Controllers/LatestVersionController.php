<?php

declare(strict_types=1);

namespace App\Integrations\Crates\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\ExtractVersion;
use App\Integrations\Actions\ExtractVersionColor;
use App\Integrations\Crates\Client;

final class LatestVersionController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $package): array
    {
        $version = $this->client->get($package)['max_version'];

        return [
            'label'       => 'crates.io',
            'status'      => ExtractVersion::execute($version),
            'statusColor' => ExtractVersionColor::execute($version),
        ];
    }
}
