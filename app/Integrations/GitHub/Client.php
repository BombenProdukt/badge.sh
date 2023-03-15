<?php

declare(strict_types=1);

namespace App\Integrations\GitHub;

use GrahamCampbell\GitHub\Facades\GitHub;
use Illuminate\Routing\Controller;

final class Client extends Controller
{
    public function makeRepoQuery(string $owner, string $repo, string $query): array
    {
        return GitHub::connection('graphql')
            ->api('graphql')
            ->execute("query { repository(owner:\"{$owner}\", name:\"{$repo}\") { {$query} } }")['data']['repository'];
    }
}
