<?php

declare(strict_types=1);

namespace App\Badges\Steam\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class FileSubscriptionsBadge extends AbstractBadge
{
    protected array $routes = [
        '/steam/file-subscriptions/{fileId}',
    ];

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $fileId): array
    {
        return $this->client->file($fileId);
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('subscriptions', $properties['subscriptions']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'file subscriptions',
                path: '/steam/file-subscriptions/100',
                data: $this->render([]),
            ),
        ];
    }
}
