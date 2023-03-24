<?php

declare(strict_types=1);

namespace App\Badges\ChromeWebStore\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class StarsBadge extends AbstractBadge
{
    public function handle(string $itemId): array
    {
        return (new RatingBadge($this->client))->handle($itemId);
    }

    public function render(array $properties): array
    {
        return $this->renderStars('stars', $properties['score']);
    }

    public function keywords(): array
    {
        return [Category::RATING];
    }

    public function routePaths(): array
    {
        return [
            '/chrome-web-store/stars/{itemId}',
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
            '/chrome-web-store/stars/ckkdlimhmcjmikdlpkmbgfkaikojcbjk' => 'stars',
        ];
    }
}
