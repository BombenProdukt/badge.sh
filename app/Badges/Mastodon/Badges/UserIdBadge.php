<?php

declare(strict_types=1);

namespace App\Badges\Mastodon\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use PreemStudio\Formatter\FormatNumber;

final class UserIdBadge extends AbstractBadge
{
    protected string $route = '/mastodon/follow/{userId:number}/{instance?}';

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
            'message' => FormatNumber::execute((float) $properties['count']),
            'messageColor' => '3487CE',
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'followers',
                path: '/mastodon/follow/26471',
                data: $this->render(['instance' => 'mastodon.social', 'username' => 'linuxxx', 'count' => '1000000']),
            ),
        ];
    }
}
