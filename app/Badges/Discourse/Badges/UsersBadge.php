<?php

declare(strict_types=1);

namespace App\Badges\Discourse\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class UsersBadge extends AbstractBadge
{
    protected array $routes = [
        '/discourse/users/{server}',
    ];

    protected array $keywords = [
        Category::METRICS,
    ];

    public function handle(string $server): array
    {
        return [
            'users' => $this->client->statistics($server)['user_count'],
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
                path: '/discourse/users/meta.discourse.org',
                data: $this->render(['users' => '1000000']),
            ),
        ];
    }
}
