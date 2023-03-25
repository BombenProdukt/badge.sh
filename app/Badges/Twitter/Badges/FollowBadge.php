<?php

declare(strict_types=1);

namespace App\Badges\Twitter\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use PreemStudio\Formatter\FormatNumber;

final class FollowBadge extends AbstractBadge
{
    protected array $routes = [
        '/twitter/follow/{username}',
    ];

    protected array $keywords = [
        Category::SOCIAL,
    ];

    protected array $deprecated = [
        '2023-03-18' => 'Deprecated due to the deprecation of required APIs.',
    ];

    public function handle(string $username): array
    {
        return [
            'username' => $username,
            'count' => $this->client->get($username)['followers_count'],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'follow @'.$properties['username'],
            'message' => FormatNumber::execute($properties['count']),
            'messageColor' => '1da1f2',
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'followers count',
                path: '/twitter/follow/rustlang',
                data: $this->render([]),
            ),
            new BadgePreviewData(
                name: 'followers count',
                path: '/twitter/follow/golang',
                data: $this->render([]),
            ),
        ];
    }
}
