<?php

declare(strict_types=1);

namespace App\Badges\Weblate\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;
use InvalidArgumentException;

final class UserStatisticsBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/weblate/statistics/{type}/{username}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::METRICS,
    ];

    public function handle(string $type, string $username): array
    {
        $response = $this->client->user($username);

        return [
            'type' => $type,
            'count' => match ($type) {
                'translations' => $response['translated'],
                'suggestions' => $response['suggested'],
                'uploads' => $response['uploaded'],
                'comments' => $response['commented'],
                'languages' => $response['languages'],
                default => throw new InvalidArgumentException("Unknown type: {$type}"),
            },
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber($properties['type'], $properties['count']);
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
            '/weblate/statistics/comments/nijel' => 'comments',
            '/weblate/statistics/languages/nijel' => 'languages',
            '/weblate/statistics/suggestions/nijel' => 'suggestions',
            '/weblate/statistics/translations/nijel' => 'translations',
            '/weblate/statistics/uploads/nijel' => 'uploads',
        ];
    }
}
