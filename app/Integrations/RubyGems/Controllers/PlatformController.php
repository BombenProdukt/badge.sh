<?php

declare(strict_types=1);

namespace App\Integrations\RubyGems\Controllers;

use App\Integrations\RubyGems\Client;
use Illuminate\Routing\Controller;

final class PlatformController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $gem): array
    {
        return [
            'label'       => 'platform',
            'status'      => $this->client->get("gems/{$gem}")['platform'],
            'statusColor' => 'green.600',
        ];
    }
}
