<?php

declare(strict_types=1);

namespace App\Integrations\DeepScan\Controllers;

use App\Integrations\Actions\FormatNumber;
use App\Integrations\DeepScan\Client;
use Illuminate\Routing\Controller;

final class LinesController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $teamId, string $projectId, string $branchId): array
    {
        $response = $this->client->get($teamId, $projectId, $branchId);

        return [
            'label'       => 'lines',
            'status'      => FormatNumber::execute($response['loc']),
            'statusColor' => 'blue.600',
        ];
    }
}
