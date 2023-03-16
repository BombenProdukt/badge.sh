<?php

declare(strict_types=1);

namespace App\Integrations\AtomPackage\Controllers;

use App\Integrations\Actions\FormatNumber;
use App\Integrations\AtomPackage\Client;
use Illuminate\Routing\Controller;

final class StarsController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $package): array
    {
        return [
            'label'       => 'stars',
            'status'      => FormatNumber::execute($this->client->get($package)['stargazers_count']),
            'statusColor' => 'green.600',
        ];
    }
}
