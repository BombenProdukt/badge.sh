<?php

declare(strict_types=1);

namespace App\Integrations\MELPA\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\ExtractVersion;
use App\Integrations\Actions\ExtractVersionColor;
use App\Integrations\MELPA\Client;

final class VersionController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $package): array
    {
        preg_match('/<title>([^<]+)<\//i', $this->client->get($package), $matches);

        [, $version] = explode(':', trim($matches[1]));

        return [
            'label'        => 'melpa',
            'status'       => ExtractVersion::execute($version),
            'statusColor'  => ExtractVersionColor::execute($version),
        ];
    }
}
