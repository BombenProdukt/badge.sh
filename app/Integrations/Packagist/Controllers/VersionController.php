<?php

declare(strict_types=1);

namespace App\Integrations\Packagist\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\ExtractVersion;
use App\Integrations\Actions\ExtractVersionColor;
use App\Integrations\Packagist\Client;
use App\Integrations\Packagist\Concerns\HandlesVersions;

final class VersionController extends AbstractController
{
    use HandlesVersions;

    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $vendor, string $package, ?string $channel = null): array
    {
        $version = $this->getVersion($this->client->get($vendor, $package), $channel);

        return [
            'label'        => 'packagist',
            'status'       => ExtractVersion::execute($version),
            'statusColor'  => ExtractVersionColor::execute($version),
        ];
    }
}
