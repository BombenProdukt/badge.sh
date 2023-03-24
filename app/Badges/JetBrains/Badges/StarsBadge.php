<?php

declare(strict_types=1);

namespace App\Badges\JetBrains\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class StarsBadge extends AbstractBadge
{
    public function handle(string $pluginId): array
    {
        if (is_numeric($pluginId)) {
            return $this->renderStars('rating', $this->client->legacy($pluginId)->filterXPath('//plugin-repository//category//idea-plugin//rating')->text());
        }

        return $this->renderStars('rating', $this->client->rating($pluginId)['meanRating']);
    }

    public function keywords(): array
    {
        return [Category::RATING];
    }

    public function routePaths(): array
    {
        return [
            '/jetbrains/stars/{pluginId}',
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
            '/jetbrains/stars/13441-laravel-idea' => 'stars',
            '/jetbrains/stars/9630'               => 'stars (legacy plugin)',
        ];
    }
}
