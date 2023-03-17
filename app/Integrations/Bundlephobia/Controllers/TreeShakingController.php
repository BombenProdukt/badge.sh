<?php

declare(strict_types=1);

namespace App\Integrations\Bundlephobia\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Bundlephobia\Client;

final class TreeShakingController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $name): array
    {
        $response        = $this->client->get($name);
        $isTreeShakeable = $response['hasJSModule'] || $response['hasJSNext'];

        return [
            'label'       => 'tree shaking',
            'status'      => $isTreeShakeable ? 'supported' : 'not supported',
            'statusColor' => $isTreeShakeable ? 'green.600' : 'red.600',
        ];
    }
}
