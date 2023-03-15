<?php

declare(strict_types=1);

namespace App\Integrations\OpenCollective\Controllers;

use App\Integrations\Actions\FormatNumber;
use App\Integrations\OpenCollective\Client;
use Illuminate\Routing\Controller;

final class ContributorsController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $package): array
    {
        $response = $this->client->get($package);

        return [
            'label'       => 'contributors',
            'status'      => FormatNumber::execute($response['contributorsCount']),
            'statusColor' => 'green.600',
        ];
    }
}
