<?php

declare(strict_types=1);

namespace App\Integrations\UptimeRobot\Controllers;

use App\Integrations\Actions\FormatPercentage;
use App\Integrations\UptimeRobot\Client;
use Illuminate\Routing\Controller;

final class DayController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $apiKey): array
    {
        $response = $this->client->get($apiKey);

        [$percentage] = explode('-', $response['custom_uptime_ratio']);

        return [
            'label'       => 'uptime /24h',
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
