<?php

declare(strict_types=1);

namespace App\Integrations\UptimeRobot\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\FormatPercentage;
use App\Integrations\UptimeRobot\Client;

final class MonthController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $apiKey): array
    {
        $response = $this->client->get($apiKey);

        [,,$percentage] = explode('-', $response['custom_uptime_ratio']);

        return [
            'label'       => 'uptime /month',
            'status'      => FormatPercentage::execute($percentage),
            'statusColor' => match (true) {
                $percentage >= 99.9 => '9C1',
                $percentage >= 99   => 'EA2',
                $percentage >= 97   => 'orange.600',
                $percentage >= 94   => 'red.600',
                default             => 'green.600',
            },
        ];
    }
}
