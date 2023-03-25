<?php

declare(strict_types=1);

namespace App\Badges\Discourse\Badges;

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
            'count' => $this->client->statistics($server)['user_count'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('users', $properties['count']);
    }

    public function previews(): array
    {
        return [
            '/discourse/users/meta.discourse.org' => 'users',
        ];
    }
}
