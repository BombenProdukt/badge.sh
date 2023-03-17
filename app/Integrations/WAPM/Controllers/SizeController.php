<?php

declare(strict_types=1);

namespace App\Integrations\WAPM\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\FormatBytes;
use App\Integrations\WAPM\Client;

final class SizeController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $package): array
    {
        return [
            'label'        => 'distrib size',
            'status'       => FormatBytes::execute($this->client->get($package)['distribution']['size']),
            'statusColor'  => 'green.600',
        ];
    }
}
