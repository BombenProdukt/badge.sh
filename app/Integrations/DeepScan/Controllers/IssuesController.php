<?php

declare(strict_types=1);

namespace App\Integrations\DeepScan\Controllers;

use App\Integrations\Actions\FormatNumber;
use App\Integrations\DeepScan\Client;
use Illuminate\Routing\Controller;

final class IssuesController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $teamId, string $projectId, string $branchId): array
    {
        $response = $this->client->get($teamId, $projectId, $branchId);

        return [
            'label'       => 'issues',
            'status'      => FormatNumber::execute($response['outstandingDefectCount']),
            'statusColor' => $response['outstandingDefectCount'] ? 'green.600' : 'yellow.600',
        ];
    }
}
