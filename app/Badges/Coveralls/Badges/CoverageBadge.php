<?php

declare(strict_types=1);

namespace App\Badges\Coveralls\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class CoverageBadge extends AbstractBadge
{
    protected array $routes = [
        '/coveralls/coverage/{vcs}/{repo}/{branch?}',
    ];

    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $vcs, string $repo, ?string $branch = null): array
    {
        $response = $this->client->get($vcs, $repo, $branch);

        \preg_match('/_(\d+)\.svg/', $response, $matches);

        return [
            'percentage' => $matches[1],
        ];
    }

    public function render(array $properties): array
    {
        if (!\is_numeric($properties['percentage'])) {
            return [
                'subject' => 'coverage',
                'message' => 'invalid',
                'messageColor' => 'gray.600',
            ];
        }

        return $this->renderCoverage($properties['percentage']);
    }

    public function routeConstraints(Route $route): void
    {
        $route->whereIn('vcs', ['github', 'bitbucket']);
        $route->where('repo', RoutePattern::CATCH_ALL->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/coveralls/coverage/github/jekyll/jekyll' => 'coverage (github)',
            '/coveralls/coverage/github/jekyll/jekyll/master' => 'coverage (github, branch)',
            '/coveralls/coverage/bitbucket/pyKLIP/pyklip' => 'coverage (bitbucket)',
            '/coveralls/coverage/bitbucket/pyKLIP/pyklip/master' => 'coverage (bitbucket, branch)',
        ];
    }
}
