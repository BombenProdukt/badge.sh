<?php

declare(strict_types=1);

namespace App\Integrations\HTTPS\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\HTTPS\Client;

final class RequestController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $host, ?string $path = null): array
    {
        $response = $this->client->get($host, $path);

        return [
            'label'       => $response['label'],
            'status'      => $response['status'],
            'statusColor' => $response['statusColor'],
        ];
    }
}
