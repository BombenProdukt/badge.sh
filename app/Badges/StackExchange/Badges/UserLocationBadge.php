<?php

declare(strict_types=1);

namespace App\Badges\StackExchange\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class UserLocationBadge extends AbstractBadge
{
    protected array $routes = [
        '/stack-exchange/user/location/{site}/{query}',
    ];

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $site, string $query): array
    {
        return $this->client->user($site, $query);
    }

    public function render(array $properties): array
    {
        return $this->renderText('location', $properties['location']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'location',
                path: '/stack-exchange/user/location/stackoverflow/123',
                data: $this->render([]),
            ),
        ];
    }
}
