<?php

declare(strict_types=1);

namespace App\Integrations\Liberapay\Controllers;

use App\Integrations\Actions\FormatNumber;
use App\Integrations\Liberapay\Client;
use Illuminate\Routing\Controller;

final class PatronsController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $username): array
    {
        $response = $this->client->get($username);

        return [
            'label'       => 'patrons',
            'status'      => FormatNumber::execute($response['npatrons']),
            'statusColor' => 'yellow.600',
        ];
    }
}
