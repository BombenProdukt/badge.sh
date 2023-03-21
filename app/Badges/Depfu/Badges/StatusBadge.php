<?php

declare(strict_types=1);

namespace App\Badges\Depfu\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Depfu\Client;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class StatusBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $vcs, string $project): array
    {
        return $this->renderStatus($this->service(), $this->client->get($vcs, $project));
    }

    public function service(): string
    {
        return 'Depfu';
    }

    public function keywords(): array
    {
        return [Category::ANALYSIS, Category::DEPENDENCIES];
    }

    public function routePaths(): array
    {
        return [
            '/depfu/status/{vcs}/{project}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->whereIn('vcs', ['github', 'gitlab']);
        $route->where('project', RoutePattern::CATCH_ALL->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/depfu/status/github/depfu/example-ruby' => 'dependencies',
        ];
    }
}
