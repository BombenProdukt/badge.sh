<?php

declare(strict_types=1);

namespace App\Integrations\RunKit\Controllers;

use App\Integrations\RunKit\Client;
use Illuminate\Routing\Controller;

final class NotebookController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $owner, string $notebook, string $path): array
    {
        $response = $this->client->get($owner, $notebook, $path);

        return [
            'label'       => $response['label'],
            'status'      => $response['status'],
            'statusColor' => $response['statusColor'],
        ];
    }
}
