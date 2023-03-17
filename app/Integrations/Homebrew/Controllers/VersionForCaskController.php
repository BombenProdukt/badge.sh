<?php

declare(strict_types=1);

namespace App\Integrations\Homebrew\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\ExtractVersion;
use App\Integrations\Actions\ExtractVersionColor;
use App\Integrations\Homebrew\Client;

final class VersionForCaskController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $package): array
    {
        $response = $this->client->get('cask', $package);

        if (isset($response['version'])) {
            $version = $response['version'];
        } else {
            $version = $response['versions']['stable'];
        }

        return [
            'label'       => 'homebrew cask',
            'status'      => ExtractVersion::execute($version),
            'statusColor' => ExtractVersionColor::execute($version),
        ];
    }
}
