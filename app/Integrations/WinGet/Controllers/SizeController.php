<?php

declare(strict_types=1);

namespace App\Integrations\WinGet\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\FormatBytes;
use App\Integrations\WinGet\Client;

final class SizeController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $appId): array
    {
        return [
            'label'        => 'winget',
            'status'       => FormatBytes::execute($this->client->get($appId)['size']),
            'statusColor'  => 'blue.600',
        ];
    }
}
