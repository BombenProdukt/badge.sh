<?php

declare(strict_types=1);

namespace App\Integrations\CRAN\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\ExtractVersion;
use App\Integrations\Actions\ExtractVersionColor;
use App\Integrations\CRAN\Client;

final class VersionController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $package): array
    {
        $response = $this->client->db($package);

        return [
            'label'        => 'cran',
            'status'       => ExtractVersion::execute($response['Version']),
            'statusColor'  => ExtractVersionColor::execute($response['Version']),
        ];
    }
}
