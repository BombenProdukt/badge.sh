<?php

declare(strict_types=1);

namespace App\Badges\PeerTube\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use PreemStudio\Formatter\FormatNumber;

final class FollowersBadge extends AbstractBadge
{
    protected array $routes = [
        '/peertube/followers/{instance}/{account}/{channel?}',
    ];

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $instance, string $account, ?string $channel = null): array
    {
        if (empty($channel)) {
            $response = $this->client->get($instance, "video-channels/{$channel}");
        } else {
            $response = $this->client->get($instance, "accounts/{$account}");
        }

        if (isset($response['data'])) {
            $followersCount = collect($response['data'])->sum('followersCount');
        } else {
            $followersCount = $response['followersCount'];
        }

        return [
            'count' => $followersCount,
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'followers',
            'message' => FormatNumber::execute((float) $properties['count']),
            'messageColor' => 'F1680D',
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'followers (account)',
                path: '/peertube/followers/framatube.org/framasoft',
                data: $this->render(['count' => '1000']),
            ),
            new BadgePreviewData(
                name: 'followers (channel)',
                path: '/peertube/followers/framatube.org/framasoft/framablog.audio',
                data: $this->render(['count' => '1000']),
            ),
        ];
    }
}
