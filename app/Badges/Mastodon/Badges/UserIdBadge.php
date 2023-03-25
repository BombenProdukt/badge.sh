<?php

declare(strict_types=1);

namespace App\Badges\Mastodon\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class UserIdBadge extends AbstractBadge
{
    protected array $routes = [
        '/mastodon/follow/{userId}/{instance?}',
    ];

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $userId, ?string $instance = 'mastodon.social'): array
    {
        $response = $this->client->get($instance, "accounts/{$userId}");

        return [
            'instance' => $instance,
            'username' => $response['username'],
            'count' => $response['followers_count'],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'follow @'.$properties['username'].'@'.$properties['instance'],
            'message' => FormatNumber::execute($properties['count']),
            'messageColor' => '3487CE',
        ];
    }

    public function routeConstraints(Route $route): void
    {
        $route->whereNumber('userId');
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [];
    }
}
