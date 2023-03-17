<?php

declare(strict_types=1);

namespace App\Integrations\CodeClimate\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\FormatPercentage;
use App\Integrations\CodeClimate\Client;

final class MaintainabilityPercentageController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $owner, string $repo): array
    {
        $response = $this->client->get($owner, $repo, 'snapshots');

        return [
            'label'       => 'maintainability',
            'status'      => FormatPercentage::execute($response['attributes']['ratings'][0]['measure']['value']),
            'statusColor' => [
                'A' => 'green.600',
                'B' => '9C0',
                'C' => 'AA2',
                'D' => 'DC2',
                'E' => 'orange.600',
            ][$response['attributes']['ratings'][0]['letter']],
        ];
    }
}
