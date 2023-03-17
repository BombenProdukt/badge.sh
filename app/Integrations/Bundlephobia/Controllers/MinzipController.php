<?php

declare(strict_types=1);

namespace App\Integrations\Bundlephobia\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\FormatBytes;
use App\Integrations\Bundlephobia\Client;

final class MinzipController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $name): array
    {
        return [
            'label'       => 'minzipped size',
            'status'      => FormatBytes::execute($this->client->get($name)['gzip']),
            'statusColor' => 'blue.600',
        ];
    }
}
