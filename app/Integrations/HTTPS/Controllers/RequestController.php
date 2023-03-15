<?php

declare(strict_types=1);

namespace App\Integrations\HTTPS\Controllers;

use App\Integrations\HTTPS\Client;
use Illuminate\Routing\Controller;

final class RequestController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $host, ?string $path = null): array
    {
        $response = $this->client->get($host, $path);

        return [
            'label'       => $response['label'],
            'status'      => $response['status'],
            'statusColor' => $response['statusColor'],
        ];
    }
}
