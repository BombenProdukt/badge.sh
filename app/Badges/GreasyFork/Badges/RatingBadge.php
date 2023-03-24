<?php

declare(strict_types=1);

namespace App\Badges\GreasyFork\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class RatingBadge extends AbstractBadge
{
    public function handle(string $scriptId): array
    {
        $response = $this->client->get($scriptId);

        return $this->renderText(
            'rating',
            sprintf('%s good, %s ok, %s bad', $response['good_ratings'], $response['ok_ratings'], $response['bad_ratings']),
            'blue.600',
        );
    }

    public function keywords(): array
    {
        return [Category::SOCIAL];
    }

    public function routePaths(): array
    {
        return [
            '/greasyfork/rating/{scriptId}',
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
            '/greasyfork/rating/407466' => 'rating',
        ];
    }
}
