<?php

declare(strict_types=1);

namespace App\Integrations\RunKit\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\RunKit\Client;

final class NotebookController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $owner, string $notebook, string $path): array
    {
        $response = $this->client->get($owner, $notebook, $path);

        return [
            'label'       => $response['label'],
            'status'      => $response['status'],
            'statusColor' => $response['statusColor'],
        ];
    }
}
