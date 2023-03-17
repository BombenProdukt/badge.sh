<?php

declare(strict_types=1);

namespace App\Integrations\DeepScan\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\DeepScan\Client;

final class GradeController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $teamId, string $projectId, string $branchId): array
    {
        $response = $this->client->get($teamId, $projectId, $branchId);

        return [
            'label'       => 'deepscan',
            'status'      => strtolower($response['grade']),
            'statusColor' => [
                'none'   => 'cecece',
                'good'   => '89b414',
                'normal' => '2148b1',
                'poor'   => 'ff5a00',
            ][strtolower($response['grade'])],
        ];
    }
}
