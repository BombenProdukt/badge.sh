<?php

declare(strict_types=1);

namespace App\Integrations\Jenkins\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Jenkins\Client;

final class LastBuildController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $hostname, string $job): array
    {
        $response = $this->client->get($hostname, $job, 'lastBuild/api/json?tree=result,timestamp,estimatedDuration');

        return [
            'label'       => 'Last Build',
            'status'      => $response['result'],
            'statusColor' => strtolower($response['result']) === 'success' ? 'green.600' : 'red.600',
        ];
    }
}
