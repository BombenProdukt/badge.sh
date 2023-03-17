<?php

declare(strict_types=1);

namespace App\Integrations\CodeClimate\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\ExtractCoverageColor;
use App\Integrations\Actions\FormatPercentage;
use App\Integrations\CodeClimate\Client;

final class CoverageController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $owner, string $repo): array
    {
        $response = $this->client->get($owner, $repo, 'test_reports');

        return [
            'label'       => 'coverage',
            'status'      => FormatPercentage::execute($response['attributes']['rating']['measure']['value']),
            'statusColor' => ExtractCoverageColor::execute($response['attributes']['rating']['measure']['value']),
        ];
    }
}
