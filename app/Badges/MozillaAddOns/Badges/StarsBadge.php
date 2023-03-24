<?php

declare(strict_types=1);

namespace App\Badges\MozillaAddOns\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class StarsBadge extends AbstractBadge
{
    public function handle(string $package): array
    {
        $response = $this->client->get($package);

        return [
            'stars' => $response['ratings']['average'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderStars('stars', $properties['stars']);
    }

    public function keywords(): array
    {
        return [Category::RATING];
    }

    public function routePaths(): array
    {
        return [
            '/amo/stars/{package}',
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
            '/amo/stars/markdown-viewer-chrome' => 'stars',
        ];
    }
}
