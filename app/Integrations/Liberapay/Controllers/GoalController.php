<?php

declare(strict_types=1);

namespace App\Integrations\Liberapay\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\FormatPercentage;
use App\Integrations\Liberapay\Client;

final class GoalController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $username): array
    {
        $response = $this->client->get($username);

        if ($response['goal']) {
            $goalAmount     = floatval($response['goal']['amount']);
            $receivesAmount = floatval($response['receiving']['amount']);
            $goal           = round(($receivesAmount / $goalAmount) * 100);
        }

        return [
            'label'       => 'goal progress',
            'status'      => FormatPercentage::execute($goal),
            'statusColor' => isset($goal) ? 'yellow.600' : 'gray.600',
        ];
    }
}
