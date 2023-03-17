<?php

declare(strict_types=1);

namespace App\Integrations\Liberapay\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\FormatMoney;
use App\Integrations\Liberapay\Client;

final class GivesController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $username): array
    {
        $response = $this->client->get($username);

        return [
            'label'       => 'gives',
            'status'      => FormatMoney::execute((float) $response['giving']['amount'], $response['giving']['currency']).'/week',
            'statusColor' => 'yellow.600',
        ];
    }
}
