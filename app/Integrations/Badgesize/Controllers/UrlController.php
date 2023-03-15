<?php

declare(strict_types=1);

namespace App\Integrations\Badgesize\Controllers;

use App\Integrations\Badgesize\Client;
use Illuminate\Routing\Controller;

final class UrlController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $compression, string $path): array
    {
        $response = $this->client->get($compression, $path);

        return [
            'label'       => $compression === 'normal' ? 'size' : "{$compression} size",
            'status'      => $response['prettySize'],
            'statusColor' => $response['color'],
        ];
    }
}
