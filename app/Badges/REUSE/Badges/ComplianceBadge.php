<?php

declare(strict_types=1);

namespace App\Badges\REUSE\Badges;

use App\Data\BadgePreviewData;
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

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'compliance',
                path: '/reuse/compliance/github.com/fsfe/reuse-tool',
                data: $this->render(['status' => 'compliant']),
            ),
        ];
    }
}
