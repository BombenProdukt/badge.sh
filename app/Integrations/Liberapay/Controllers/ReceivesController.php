<?php

declare(strict_types=1);

namespace App\Integrations\Liberapay\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\FormatMoney;
use App\Integrations\Liberapay\Client;

final class ReceivesController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $username): array
    {
        $response = $this->client->get($username);

        return [
            'label'       => 'receives',
            'status'      => FormatMoney::execute((float) $response['receiving']['amount'], $response['receiving']['currency']).'/week',
            'statusColor' => 'yellow.600',
        ];
    }
}
