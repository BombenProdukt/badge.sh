<?php

declare(strict_types=1);

namespace App\Integrations\DeepScan\Controllers;

use App\Integrations\DeepScan\Client;
use Illuminate\Routing\Controller;

final class GradeController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $teamId, string $projectId, string $branchId): array
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
