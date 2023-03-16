<?php

declare(strict_types=1);

namespace App\Integrations\CodeClimate\Controllers;

use App\Integrations\CodeClimate\Client;
use Illuminate\Routing\Controller;

final class MaintainabilityController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $owner, string $repo): array
    {
        $response = $this->client->get($owner, $repo, 'snapshots');

        return [
            'label'       => 'maintainability',
            'status'      => $response['attributes']['ratings'][0]['letter'],
            'statusColor' => [
                'A' => 'green.600',
                'B' => '9C0',
                'C' => 'AA2',
                'D' => 'DC2',
                'E' => 'orange.600',
            ][$response['attributes']['ratings'][0]['letter']],
        ];
    }
}
