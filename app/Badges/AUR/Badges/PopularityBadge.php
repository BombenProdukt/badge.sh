<?php

declare(strict_types=1);

namespace App\Badges\AUR\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class PopularityBadge extends AbstractBadge
{
    public function handle(string $package): array
    {
        return [
            'popularity' => $this->client->get($package)['Popularity'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('popularity', $properties['popularity']);
    }

    public function keywords(): array
    {
        return [Category::RATING];
    }

    public function routePaths(): array
    {
        return [
            '/aur/popularity/{package}',
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
            '/aur/popularity/google-chrome' => 'popularity',
        ];
    }
}
