<?php

declare(strict_types=1);

namespace App\Integrations\Tidelift\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Tidelift\Client;

final class StatusController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $platform, string $name): array
    {
        $location = $this->client->get($platform, $name);

        if (empty($location)) {
            return [
                'label'       => 'tidelift',
                'status'      => 'not found',
                'statusColor' => 'red.600',
            ];
        }

        [, $status, $statusColor] = explode('-', parse_url(urldecode($location))['path']);

        return [
            'label'       => 'tidelift',
            'status'      => str_replace('!', '', $status),
            'statusColor' => str_replace('.svg', '', $statusColor),
        ];
    }
}
