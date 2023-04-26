<?php

declare(strict_types=1);

namespace App\Badges\DUB;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class StarsBadge extends AbstractBadge
{
    protected string $route = '/dub/stars/{package}';

    protected array $keywords = [
        Category::RATING,
    ];

    public function handle(string $package): array
    {
        return $this->client->get("{$package}/stats");
    }

    public function render(array $properties): array
    {
        return $this->renderStars('stars', $properties['score']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'stars',
                path: '/dub/stars/silly',
                data: $this->render(['score' => '4.5']),
            ),
        ];
    }
}
