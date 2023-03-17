<?php

declare(strict_types=1);

namespace App\Integrations\DUB\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\ExtractVersion;
use App\Integrations\Actions\ExtractVersionColor;
use App\Integrations\DUB\Client;

final class VersionController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $package): array
    {
        $version = $this->client->get("{$package}/latest");

        return [
            'label'        => 'dub',
            'status'       => ExtractVersion::execute($version),
            'statusColor'  => ExtractVersionColor::execute($version),
        ];
    }
}
