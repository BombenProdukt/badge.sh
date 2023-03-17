<?php

declare(strict_types=1);

namespace App\Integrations\FDroid\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\ExtractVersion;
use App\Integrations\Actions\ExtractVersionColor;
use App\Integrations\FDroid\Client;

final class VersionController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $appId): array
    {
        $version = $this->client->get($appId)['CurrentVersion'];

        return [
            'label'        => 'opam',
            'status'       => ExtractVersion::execute($version),
            'statusColor'  => ExtractVersionColor::execute($version),
        ];
    }
}
