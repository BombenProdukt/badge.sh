<?php

declare(strict_types=1);

namespace App\Integrations\GitHub\Controllers;

use App\Integrations\Actions\FormatNumber;
use App\Integrations\GitHub\Client;
use Illuminate\Routing\Controller;

final class CommitsController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $owner, string $repo, string $reference = ''): array
    {
        $reference ??= 'main';
        $result = $this->client->makeRepoQuery($owner, $repo, "branch: ref(qualifiedName: \"{$reference}\") { target { ... on Commit { history(first: 0) { totalCount } } } }");

        return [
            'label'       => 'commits',
            'status'      => FormatNumber::execute($result['branch']['target']['history']['totalCount']),
            'statusColor' => 'blue.600',
        ];
    }
}
