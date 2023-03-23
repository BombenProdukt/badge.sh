<?php

declare(strict_types=1);

namespace App\Badges\ScrutinizerCI\Badges;

use App\Badges\AbstractBadge;
use App\Badges\ScrutinizerCI\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class BuildBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $vcs, string $user, string $repo, ?string $branch = 'master'): array
    {
        return $this->renderStatus('build status', $this->client->get($vcs, $user, $repo)['applications'][$branch]['build_status']['status']);
    }

    public function service(): string
    {
        return 'Scrutinizer';
    }

    public function keywords(): array
    {
        return [Category::ANALYSIS];
    }

    public function routePaths(): array
    {
        return [
            '/scrutinizer-ci/build/{vcs}/{user}/{repo}/{branch?}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->whereIn('vcs', ['g', 'gl', 'b']);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/scrutinizer-ci/build/g/filp/whoops' => 'build',
        ];
    }
}
