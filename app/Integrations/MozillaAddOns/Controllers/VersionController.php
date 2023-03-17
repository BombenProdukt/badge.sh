<?php

declare(strict_types=1);

namespace App\Integrations\MozillaAddOns\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\ExtractVersion;
use App\Integrations\Actions\ExtractVersionColor;
use App\Integrations\MozillaAddOns\Client;

final class VersionController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $package): array
    {
        $response = $this->client->get($package);

        return [
            'label'        => 'mozilla add-on',
            'status'       => ExtractVersion::execute($response['current_version']['version']),
            'statusColor'  => ExtractVersionColor::execute($response['current_version']['version']),
        ];
    }
}
