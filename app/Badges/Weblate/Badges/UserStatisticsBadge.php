<?php

declare(strict_types=1);

namespace App\Badges\Weblate\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;
use InvalidArgumentException;

final class UserStatisticsBadge extends AbstractBadge
{
    public function handle(string $type, string $username): array
    {
        $response = $this->client->user($username);

        return [
            'type'  => $type,
            'count' => match ($type) {
                'translations' => $response['translated'],
                'suggestions'  => $response['suggested'],
                'uploads'      => $response['uploaded'],
                'comments'     => $response['commented'],
                'languages'    => $response['languages'],
                default        => throw new InvalidArgumentException("Unknown type: {$type}")
            },
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber($properties['type'], $properties['count']);
    }

    public function keywords(): array
    {
        return [Category::METRICS];
    }

    public function routePaths(): array
    {
        return [
            '/weblate/statistics/{type}/{username}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->whereIn('type', ['translations', 'suggestions', 'languages', 'uploads', 'comments']);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/weblate/statistics/comments/nijel'     => 'comments',
            '/weblate/statistics/languages/nijel'    => 'languages',
            '/weblate/statistics/suggestions/nijel'  => 'suggestions',
            '/weblate/statistics/translations/nijel' => 'translations',
            '/weblate/statistics/uploads/nijel'      => 'uploads',
        ];
    }
}
