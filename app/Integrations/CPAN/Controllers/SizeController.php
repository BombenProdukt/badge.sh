<?php

declare(strict_types=1);

namespace App\Integrations\CPAN\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\FormatBytes;
use App\Integrations\CPAN\Client;

final class SizeController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $distribution): array
    {
        return [
            'label'       => 'size',
            'status'      => FormatBytes::execute($this->client->get("release/{$distribution}")['stat']['size']),
            'statusColor' => 'blue.600',
        ];
    }
}
