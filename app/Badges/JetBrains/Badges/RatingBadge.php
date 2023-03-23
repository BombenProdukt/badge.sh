<?php

declare(strict_types=1);

namespace App\Badges\JetBrains\Badges;

use App\Badges\AbstractBadge;
use App\Badges\JetBrains\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class RatingBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $pluginId): array
    {
        if (is_numeric($pluginId)) {
            return $this->renderRating($this->client->legacy($pluginId)->filterXPath('//plugin-repository//category//idea-plugin//rating')->text());
        }

        return $this->renderRating($this->client->rating($pluginId)['meanRating']);
    }

    public function service(): string
    {
        return 'JetBrains Plugins';
    }

    public function keywords(): array
    {
        return [Category::RATING];
    }

    public function routePaths(): array
    {
        return [
            '/jetbrains/rating/{pluginId}',
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
            '/jetbrains/rating/13441-laravel-idea' => 'rating',
            '/jetbrains/rating/9630'               => 'rating (legacy plugin)',
        ];
    }
}
