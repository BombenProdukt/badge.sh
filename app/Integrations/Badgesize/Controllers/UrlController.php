<?php

declare(strict_types=1);

namespace App\Integrations\Badgesize\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Badgesize\Client;

final class UrlController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $compression, string $path): array
    {
        $response = $this->client->get($compression, 'https:/'.str_replace(['https://', 'https/'], '', $path));

        return [
            'label'       => $compression === 'normal' ? 'size' : "{$compression} size",
            'status'      => $response['prettySize'],
            'statusColor' => $response['color'],
        ];
    }
}
