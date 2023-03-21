<?php

declare(strict_types=1);

namespace App\Badges\Coveralls\Badges;

use App\Badges\Coveralls\Client;
use App\Badges\Templates\CoverageTemplate;
use App\Contracts\Badge;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class CoverageBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $vcs, string $repo, ?string $branch = null): array
    {
        $response = $this->client->get($vcs, $repo, $branch);

        preg_match('/_(\d+)\.svg/', $response, $matches);

        if (! is_numeric($matches[1])) {
            return [
                'subject'      => 'coverage',
                'message'      => 'invalid',
                'messageColor' => 'gray.600',
            ];
        }

        return CoverageTemplate::make($matches[1]);
    }

    public function service(): string
    {
        return 'Coveralls';
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
            '/coveralls/coverage/{vcs}/{repo}/{branch?}',
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
        $route->whereIn('vcs', ['github', 'bitbucket']);
        $route->where('repo', RoutePattern::CATCH_ALL->value);
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
            '/coveralls/coverage/github/jekyll/jekyll'           => 'coverage (github)',
            '/coveralls/coverage/github/jekyll/jekyll/master'    => 'coverage (github, branch)',
            '/coveralls/coverage/bitbucket/pyKLIP/pyklip'        => 'coverage (bitbucket)',
            '/coveralls/coverage/bitbucket/pyKLIP/pyklip/master' => 'coverage (bitbucket, branch)',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
