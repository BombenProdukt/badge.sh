<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Enums\Category;
use GrahamCampbell\GitHub\Facades\GitHub;

final class CommitsBadge extends AbstractBadge
{
    protected array $routes = [
        '/github/commits/{owner}/{repo}/{reference?}',
    ];

    protected array $keywords = [
        Category::ACTIVITY,
    ];

    public function handle(string $owner, string $repo, ?string $reference = null): array
    {
        if (empty($reference)) {
            $response = GitHub::connection('main')->api('repo')->show($owner, $repo);
            $reference = $response['default_branch'];
        }

        $result = $this->client->makeRepoQuery($owner, $repo, "branch: ref(qualifiedName: \"{$reference}\") { target { ... on Commit { history(first: 0) { totalCount } } } }");

        return [
            'count' => $result['branch']['target']['history']['totalCount'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('commits', $properties['count']);
    }

    public function previews(): array
    {
        return [
            '/github/commits/micromatch/micromatch' => 'commits count',
            '/github/commits/micromatch/micromatch/gh-pages' => 'commits count (branch ref)',
            '/github/commits/micromatch/micromatch/4.0.1' => 'commits count (tag ref)',
        ];
    }
}
