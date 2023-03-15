<?php

declare(strict_types=1);

namespace App\Integrations\FDroid\Controllers;

use App\Integrations\FDroid\Client;
use Illuminate\Routing\Controller;

final class LicenseController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $appId): array
    {
        return [
            'label'       => 'license',
            'status'      => $this->client->get($appId)['License'] ?? 'unknown',
            'statusColor' => 'blue.600',
        ];
    }
}
