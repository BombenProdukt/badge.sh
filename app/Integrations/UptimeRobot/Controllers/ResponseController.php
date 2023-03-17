<?php

declare(strict_types=1);

namespace App\Integrations\UptimeRobot\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\UptimeRobot\Client;

final class ResponseController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $apiKey): array
    {
        return [
            'label'       => 'response',
            'status'      => $this->client->get($apiKey)['average_response_time'].'ms',
            'statusColor' => 'blue.600',
        ];
    }
}
