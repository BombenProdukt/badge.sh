<?php

declare(strict_types=1);

namespace App\Badges\MozillaAddOns\Badges;

use App\Enums\Category;

final class UsersBadge extends AbstractBadge
{
    protected array $routes = [
        '/amo/users/{package}',
    ];

    protected array $keywords = [
        Category::DOWNLOADS, Category::SOCIAL,
    ];

    public function handle(string $package): array
    {
        return [
            'count' => $this->client->get($package)['average_daily_users'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('users', $properties['count']);
    }

    public function previews(): array
    {
        return [
            '/amo/users/markdown-viewer-chrome' => 'users',
        ];
    }
}
