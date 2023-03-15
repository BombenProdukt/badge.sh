<?php

declare(strict_types=1);

namespace App\Integrations\GitHub\Controllers;

use App\Integrations\GitHub\Client;
use Carbon\Carbon;
use Illuminate\Routing\Controller;

final class LastCommitController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $owner, string $repo, string $reference): array
    {
        $result = $this->client->makeRepoQuery($owner, $repo, "branch: ref(qualifiedName: \"{$reference}\") { target { ... on Commit { history(first: 1) { nodes { committedDate } } } } }");

        return [
            'label'       => 'last commit',
            'status'      => Carbon::parse($result['branch']['target']['history']['nodes'][0]['committedDate'])->diffForHumans(),
            'statusColor' => 'green.600',
        ];
    }
}
