<?php

declare(strict_types=1);

namespace App\Integrations\CPAN\Controllers;

use App\Integrations\Actions\FormatNumber;
use App\Integrations\CPAN\Client;
use Illuminate\Routing\Controller;

final class DependentsController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $distribution): array
    {
        return [
            'label'       => 'dependents',
            'status'      => FormatNumber::execute($this->client->get("reverse_dependencies/dist/{$distribution}")['total'] ?? 0),
            'statusColor' => 'green.600',
        ];
    }
}
