<?php

declare(strict_types=1);

namespace App\Integrations\OpenCollective\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\FormatMoney;
use App\Integrations\OpenCollective\Client;

final class BalanceController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $slug): array
    {
        $response = $this->client->get($slug);

        return [
            'label'       => 'balance',
            'status'      => FormatMoney::execute($response['balance'] / 100, $response['currency']),
            'statusColor' => 'green.600',
        ];
    }
}
