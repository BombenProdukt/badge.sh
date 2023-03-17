<?php

declare(strict_types=1);

namespace App\Integrations\GitHub\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\GitHub\Client;
use Carbon\Carbon;
use GrahamCampbell\GitHub\Facades\GitHub;

final class LastCommitController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $owner, string $repo, ?string $reference = null): array
    {
        if (empty($reference)) {
            $response  = GitHub::connection('main')->api('repo')->show($owner, $repo);
            $reference = $response['default_branch'];
        }

        $result = $this->client->makeRepoQuery($owner, $repo, "branch: ref(qualifiedName: \"{$reference}\") { target { ... on Commit { history(first: 1) { nodes { committedDate } } } } }");

        return [
            'label'       => 'last commit',
            'status'      => Carbon::parse($result['branch']['target']['history']['nodes'][0]['committedDate'])->diffForHumans(),
            'statusColor' => 'green.600',
        ];
    }
}
