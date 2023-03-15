<?php

declare(strict_types=1);

namespace App\Integrations\DevRant\Controllers;

use App\Integrations\DevRant\Client;
use Illuminate\Routing\Controller;

final class StatusController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $package): array
    {
        $version = $this->client->get($package);

        return [
            'label'       => 'TODO',
            'status'      => 'TODO',
            'statusColor' => 'TODO',
        ];
    }
}
