<?php

declare(strict_types=1);

namespace App\Badges\MozillaAddOns\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class UsersBadge extends AbstractBadge
{
    protected string $route = '/amo/users/{package}';

    protected array $keywords = [
        Category::DOWNLOADS, Category::SOCIAL,
    ];

    public function handle(string $package): array
    {
        return [
            'users' => $this->client->get($package)['average_daily_users'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('users', $properties['users']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'users',
                path: '/amo/users/markdown-viewer-chrome',
                data: $this->render(['users' => '1000000']),
            ),
        ];
    }
}
