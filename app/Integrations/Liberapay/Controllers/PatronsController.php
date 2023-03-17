<?php

declare(strict_types=1);

namespace App\Integrations\Liberapay\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\FormatNumber;
use App\Integrations\Liberapay\Client;

final class PatronsController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $username): array
    {
        $response = $this->client->get($username);

        return [
            'label'       => 'patrons',
            'status'      => FormatNumber::execute($response['npatrons']),
            'statusColor' => 'yellow.600',
        ];
    }
}
