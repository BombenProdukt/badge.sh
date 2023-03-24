<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Enums\Category;
use Carbon\Carbon;
use GrahamCampbell\GitHub\Facades\GitHub;
use Illuminate\Routing\Route;

final class LastCommitBadge extends AbstractBadge
{
    public function handle(string $owner, string $repo, ?string $reference = null): array
    {
        if (empty($reference)) {
            $response  = GitHub::connection('main')->api('repo')->show($owner, $repo);
            $reference = $response['default_branch'];
        }

        $result = $this->client->makeRepoQuery($owner, $repo, "branch: ref(qualifiedName: \"{$reference}\") { target { ... on Commit { history(first: 1) { nodes { committedDate } } } } }");

        return [
            'label'        => 'last commit',
            'message'      => Carbon::parse($result['branch']['target']['history']['nodes'][0]['committedDate'])->diffForHumans(),
            'messageColor' => 'green.600',
        ];
    }

    public function keywords(): array
    {
        return [Category::ACTIVITY];
    }

    public function routePaths(): array
    {
        return [
            '/github/last-commit/{owner}/{repo}/{reference?}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        //
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/github/last-commit/micromatch/micromatch'          => 'last commit',
            '/github/last-commit/micromatch/micromatch/gh-pages' => 'last commit (branch ref)',
            '/github/last-commit/micromatch/micromatch/4.0.1'    => 'last commit (tag ref)',
        ];
    }
}
