<?php

declare(strict_types=1);

namespace App\Integrations\CodeClimate\Controllers;

use App\Integrations\Actions\FormatNumber;
use App\Integrations\CodeClimate\Client;
use Illuminate\Routing\Controller;

final class LocController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $owner, string $repo): array
    {
        $response = $this->client->get($owner, $repo, 'snapshots');

        return [
            'label'       => 'lines of code',
            'status'      => FormatNumber::execute($response['attributes']['lines_of_code']),
            'statusColor' => 'blue.600',
        ];
    }
}
