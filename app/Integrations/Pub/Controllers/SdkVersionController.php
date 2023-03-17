<?php

declare(strict_types=1);

namespace App\Integrations\Pub\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\ExtractVersion;
use App\Integrations\Actions\ExtractVersionColor;
use App\Integrations\Pub\Client;

final class SdkVersionController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $package): array
    {
        $version = $this->client->api("packages/{$package}")['latest']['pubspec']['environment']['sdk'];

        return [
            'label'        => 'dart sdk',
            'status'       => ExtractVersion::execute($version),
            'statusColor'  => ExtractVersionColor::execute($version),
        ];
    }
}
