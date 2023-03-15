<?php

declare(strict_types=1);

namespace App\Integrations\Dependabot\Controllers;

use App\Integrations\Dependabot\Client;
use Illuminate\Routing\Controller;

final class StatusController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $owner, string $repo, ?string $identifier = null): array
    {
        $response = $this->client->get($owner, $repo, $identifier);

        return [
            'label'       => 'Dependabot',
            'status'      => $response['status'],
            'statusColor' => $response['colour'],
        ];
    }
}
