<?php

declare(strict_types=1);

namespace App\Integrations\GitHub;

use GrahamCampbell\GitHub\Facades\GitHub;

final class Client
{
    public function makeRepoQuery(string $owner, string $repo, string $query): array
    {
        return GitHub::connection('graphql')
            ->api('graphql')
            ->execute("query { repository(owner:\"{$owner}\", name:\"{$repo}\") { {$query} } }")['data']['repository'];
    }
}
