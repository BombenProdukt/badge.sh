<?php

declare(strict_types=1);

namespace App\Integrations\CocoaPods\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\ExtractVersion;
use App\Integrations\Actions\ExtractVersionColor;
use App\Integrations\CocoaPods\Client;

final class VersionController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $pod): array
    {
        $response = $this->client->get($pod);

        return [
            'label'       => 'pod',
            'status'      => ExtractVersion::execute($response['version']),
            'statusColor' => ExtractVersionColor::execute($response['version']),
        ];
    }
}
