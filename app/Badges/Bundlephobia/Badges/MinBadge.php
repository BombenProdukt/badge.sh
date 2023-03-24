<?php

declare(strict_types=1);

namespace App\Badges\Bundlephobia\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatBytes;

final class MinBadge extends AbstractBadge
{
    public function handle(string $name): array
    {
        return [
            'label'        => 'minified size',
            'message'      => FormatBytes::execute($this->client->get($name)['size']),
            'messageColor' => 'blue.600',
        ];
    }

    public function keywords(): array
    {
        return [Category::SIZE];
    }

    public function routePaths(): array
    {
        return [
            '/bundlephobia/min/{name}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('name', RoutePattern::CATCH_ALL->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/bundlephobia/min/react' => 'minified',
        ];
    }
}
