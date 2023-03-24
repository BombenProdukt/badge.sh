<?php

declare(strict_types=1);

namespace App\Badges\REUSE\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class ComplianceBadge extends AbstractBadge
{
    public function handle(string $remote): array
    {
        return $this->renderStatus('reuse', $this->client->get($remote)['status']);
    }

    public function keywords(): array
    {
        return [Category::LICENSE];
    }

    public function routePaths(): array
    {
        return [
            '/reuse/compliance/{remote}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
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
