<?php

declare(strict_types=1);

namespace App\Integrations\GitHub\Controllers;

use App\Integrations\Actions\ExtractVersion;
use App\Integrations\GitHub\Client;
use Illuminate\Routing\Controller;

final class TagController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $owner, string $repo): array
    {
        $result    = $this->client->makeRepoQuery($owner, $repo, 'refs(last: 1, refPrefix: "refs/tags/", orderBy: { field: TAG_COMMIT_DATE, direction: ASC }) { edges { node { name } } }');
        $tags      = $result['refs']['edges'];
        $latestTag = count($tags) > 0 ? $tags[0]['node']['name'] : null;

        return [
            'label'       => 'latest tag',
            'status'      => ExtractVersion::execute($latestTag),
            'statusColor' => 'blue.600',
        ];
    }
}
