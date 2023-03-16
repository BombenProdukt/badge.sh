<?php

declare(strict_types=1);

namespace App\Integrations\Liberapay\Controllers;

use App\Integrations\Actions\FormatMoney;
use App\Integrations\Liberapay\Client;
use Illuminate\Routing\Controller;

final class ReceivesController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $username): array
    {
        $response = $this->client->get($username);

        return [
            'label'       => 'receives',
            'status'      => FormatMoney::execute((float) $response['receiving']['amount'], $response['receiving']['currency']).'/week',
            'statusColor' => 'yellow.600',
        ];
    }
}
