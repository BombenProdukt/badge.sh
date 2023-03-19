<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Badges\GitHub\Client;
use App\Contracts\Badge;
use Carbon\Carbon;
use GrahamCampbell\GitHub\Facades\GitHub;
use Illuminate\Routing\Route;

final class LastCommitBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

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

    public function service(): string
    {
        return 'GitHub';
    }

    public function title(): string
    {
        return '';
    }

    public function keywords(): array
    {
        return [
            //
        ];
    }

    public function routePaths(): array
    {
        return [
            '/github/{owner}/{repo}/commits/latest/{reference?}',
        ];
    }

    public function routeParameters(): array
    {
        return [
            //
        ];
    }

    public function routeConstraints(Route $route): void
    {
        //
    }

    public function staticPreviews(): array
    {
        return [
            //
        ];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/github/micromatch/micromatch/commits/latest'          => 'last commit',
            '/github/micromatch/micromatch/commits/latest/gh-pages' => 'last commit (branch ref)',
            '/github/micromatch/micromatch/commits/latest/4.0.1'    => 'last commit (tag ref)',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
