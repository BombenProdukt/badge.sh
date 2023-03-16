<?php

declare(strict_types=1);

namespace App\Integrations\NPM\Controllers;

use App\Integrations\Actions\FormatNumber;
use App\Integrations\NPM\Client;
use Illuminate\Routing\Controller;

final class DependentsController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $package, string $tag = 'latest'): array
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
