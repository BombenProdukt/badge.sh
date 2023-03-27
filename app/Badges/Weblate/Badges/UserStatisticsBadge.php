<?php

declare(strict_types=1);

namespace App\Badges\Weblate\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use InvalidArgumentException;

final class UserStatisticsBadge extends AbstractBadge
{
    protected string $route = '/weblate/statistics/{type:translations,suggestions,languages,uploads,comments}/{username}';

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

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'comments',
                path: '/weblate/statistics/comments/nijel',
                data: $this->render(['type' => 'translations', 'count' => '0']),
            ),
            new BadgePreviewData(
                name: 'languages',
                path: '/weblate/statistics/languages/nijel',
                data: $this->render(['type' => 'suggestions', 'count' => '0']),
            ),
            new BadgePreviewData(
                name: 'suggestions',
                path: '/weblate/statistics/suggestions/nijel',
                data: $this->render(['type' => 'uploads', 'count' => '0']),
            ),
            new BadgePreviewData(
                name: 'translations',
                path: '/weblate/statistics/translations/nijel',
                data: $this->render(['type' => 'comments', 'count' => '0']),
            ),
            new BadgePreviewData(
                name: 'uploads',
                path: '/weblate/statistics/uploads/nijel',
                data: $this->render(['type' => 'languages', 'count' => '0']),
            ),
        ];
    }
}
