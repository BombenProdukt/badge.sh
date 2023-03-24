<?php

declare(strict_types=1);

namespace App\Badges\ChromeWebStore\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class UsersBadge extends AbstractBadge
{
    public function handle(string $itemId): array
    {
        preg_match('|<span class="e-f-ih" title="(.*?)">(.*?)</span>|', $this->client->get($itemId), $matches);

        return [
            'count' => filter_var($matches[1], FILTER_SANITIZE_NUMBER_INT),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderRating($properties['count']);
    }

    public function keywords(): array
    {
        return [Category::DOWNLOADS];
    }

    public function routePaths(): array
    {
        return [
            '/chrome-web-store/users/{itemId}',
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
            '/chrome-web-store/users/ckkdlimhmcjmikdlpkmbgfkaikojcbjk' => 'users',
        ];
    }
}
