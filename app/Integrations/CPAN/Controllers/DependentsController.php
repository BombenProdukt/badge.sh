<?php

declare(strict_types=1);

namespace App\Integrations\CPAN\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\FormatNumber;
use App\Integrations\CPAN\Client;

final class DependentsController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $distribution): array
    {
        return [
            'label'       => 'dependents',
            'status'      => FormatNumber::execute($this->client->get("reverse_dependencies/dist/{$distribution}")['total'] ?? 0),
            'statusColor' => 'green.600',
        ];
    }
}
