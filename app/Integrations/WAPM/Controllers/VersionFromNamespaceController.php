<?php

declare(strict_types=1);

namespace App\Integrations\WAPM\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\ExtractVersion;
use App\Integrations\Actions\ExtractVersionColor;
use App\Integrations\WAPM\Client;

final class VersionFromNamespaceController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $namespace, string $package): array
    {
        $response = $this->client->get($package, $namespace);

        return [
            'label'        => 'wapm',
            'status'       => ExtractVersion::execute($response['version']),
            'statusColor'  => ExtractVersionColor::execute($response['version']),
        ];
    }
}
