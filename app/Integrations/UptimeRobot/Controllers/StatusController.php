<?php

declare(strict_types=1);

namespace App\Integrations\UptimeRobot\Controllers;

use App\Integrations\UptimeRobot\Client;
use Illuminate\Routing\Controller;

final class StatusController extends Controller
{
    private array $statuses = [
        '0' => ['paused', 'yellow.600'],
        '1' => ['not checked yet', 'gray.600'],
        '2' => ['up', 'green.600'],
        '8' => ['seems down', 'orange.600'],
        '9' => ['down', 'red.600'],
    ];

    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $apiKey): array
    {
        $response = $this->client->get($apiKey);

        return [
            'label'       => 'status',
            'status'      => $this->statuses[$response['status']][0],
            'statusColor' => $this->statuses[$response['status']][1],
        ];
    }
}
