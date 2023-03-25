<?php

declare(strict_types=1);

namespace App\Badges\REUSE\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class ComplianceBadge extends AbstractBadge
{
    protected array $routes = [
        '/reuse/compliance/{remote}',
    ];

    protected array $keywords = [
        Category::LICENSE,
    ];

    public function handle(string $remote): array
    {
        return $this->client->get($remote);
    }

    public function render(array $properties): array
    {
        return $this->renderStatus('reuse', $properties['status']);
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('remote', RoutePattern::CATCH_ALL->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/reuse/compliance/github.com/fsfe/reuse-tool' => 'compliance',
        ];
    }
}
