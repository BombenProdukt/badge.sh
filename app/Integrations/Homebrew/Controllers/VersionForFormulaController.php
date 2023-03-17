<?php

declare(strict_types=1);

namespace App\Integrations\Homebrew\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\ExtractVersion;
use App\Integrations\Actions\ExtractVersionColor;
use App\Integrations\Homebrew\Client;

final class VersionForFormulaController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $package): array
    {
        $version = $this->client->get('formula', $package)['versions']['stable'];

        return [
            'label'       => 'homebrew',
            'status'      => ExtractVersion::execute($version),
            'statusColor' => ExtractVersionColor::execute($version),
        ];
    }
}
