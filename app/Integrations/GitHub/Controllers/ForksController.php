<?php

declare(strict_types=1);

namespace App\Integrations\GitHub\Controllers;

use App\Integrations\Actions\FormatNumber;
use App\Integrations\GitHub\Client;
use Illuminate\Routing\Controller;

final class ForksController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $owner, string $repo): array
    {
        $result = $this->client->makeRepoQuery($owner, $repo, 'forks { totalCount }');

        return [
            'label'       => 'forks',
            'status'      => FormatNumber::execute($result['forks']['totalCount']),
            'statusColor' => 'blue.600',
        ];
    }
}
