<?php

declare(strict_types=1);

namespace App\Integrations\UptimeRobot\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\UptimeRobot\Client;

final class StatusController extends AbstractController
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

    protected function handleRequest(string $apiKey): array
    {
        $response = $this->client->get($apiKey);

        return [
            'label'       => 'status',
            'status'      => $this->statuses[$response['status']][0],
            'statusColor' => $this->statuses[$response['status']][1],
        ];
    }
}
