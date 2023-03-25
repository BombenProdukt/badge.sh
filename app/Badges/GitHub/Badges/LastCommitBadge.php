<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Enums\Category;
use GrahamCampbell\GitHub\Facades\GitHub;

final class LastCommitBadge extends AbstractBadge
{
    protected array $routes = [
        '/github/last-commit/{owner}/{repo}/{reference?}',
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

        $result = $this->client->makeRepoQuery($owner, $repo, "branch: ref(qualifiedName: \"{$reference}\") { target { ... on Commit { history(first: 1) { nodes { committedDate } } } } }");

        return [
            'date' => $result['branch']['target']['history']['nodes'][0]['committedDate'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderDateDiff('last commit', $properties['date']);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/github/last-commit/micromatch/micromatch' => 'last commit',
            '/github/last-commit/micromatch/micromatch/gh-pages' => 'last commit (branch ref)',
            '/github/last-commit/micromatch/micromatch/4.0.1' => 'last commit (tag ref)',
        ];
    }
}
