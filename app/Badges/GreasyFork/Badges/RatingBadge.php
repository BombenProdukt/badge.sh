<?php

declare(strict_types=1);

namespace App\Badges\GreasyFork\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class RatingBadge extends AbstractBadge
{
    protected array $routes = [
        '/greasyfork/rating/{scriptId}',
    ];

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $scriptId): array
    {
        $response = $this->client->get($scriptId);

        return [
            'good' => $response['good_ratings'],
            'ok' => $response['ok_ratings'],
            'bad' => $response['bad_ratings'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderText(
            'rating',
            \sprintf('%s good, %s ok, %s bad', $properties['good'], $properties['ok'], $properties['bad']),
            'blue.600',
        );
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'rating',
                path: '/greasyfork/rating/407466',
                data: $this->render([
                    'good' => 1,
                    'ok' => 0,
                    'bad' => 0,
                ]),
            ),
            new BadgePreviewData(
                name: 'rating',
                path: '/greasyfork/rating/407466',
                data: $this->render([
                    'good' => 0,
                    'ok' => 1,
                    'bad' => 0,
                ]),
            ),
            new BadgePreviewData(
                name: 'rating',
                path: '/greasyfork/rating/407466',
                data: $this->render([
                    'good' => 0,
                    'ok' => 0,
                    'bad' => 1,
                ]),
            ),
        ];
    }
}
