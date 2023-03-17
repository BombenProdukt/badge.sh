<?php

declare(strict_types=1);

namespace App\Integrations\NPM\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\FormatNumber;
use App\Integrations\NPM\Client;

final class DependentsController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $package, string $tag = 'latest'): array
    {
        $response = $this->client->web("package/{$package}");

        preg_match('/"dependentsCount"\s*:\s*(\d+)/', $response, $matches);

        return [
            'label'       => 'dependents',
            'status'      => FormatNumber::execute((int) $matches[1]),
            'statusColor' => 'green.600',
        ];
    }
}
