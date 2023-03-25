<?php

declare(strict_types=1);

namespace App\Badges\Steam\Badges;

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

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/steam/file-subscriptions/100' => 'file subscriptions',
        ];
    }
}
