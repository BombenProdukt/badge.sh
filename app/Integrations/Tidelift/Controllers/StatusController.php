<?php

declare(strict_types=1);

namespace App\Integrations\Tidelift\Controllers;

use App\Integrations\Tidelift\Client;
use Illuminate\Routing\Controller;

final class StatusController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $platform, string $name): array
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
