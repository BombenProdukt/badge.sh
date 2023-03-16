<?php

declare(strict_types=1);

namespace App\Integrations\Jenkins\Controllers;

use App\Integrations\Jenkins\Client;
use Illuminate\Routing\Controller;

final class LastBuildController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $hostname, string $job): array
    {
        $response = $this->client->get($hostname, $job, 'lastBuild/api/json?tree=result,timestamp,estimatedDuration');

        return [
            'label'       => 'Last Build',
            'status'      => $response['result'],
            'statusColor' => strtolower($response['result']) === 'success' ? 'green.600' : 'red.600',
        ];
    }
}
