<?php

declare(strict_types=1);

namespace App\Badges\PeerTube\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class FollowersBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/peertube/followers/{instance}/{account}/{channel?}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
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
            'message' => FormatNumber::execute($properties['count']),
            'messageColor' => 'F1680D',
        ];
    }

    public function routeConstraints(Route $route): void
    {
        //
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/peertube/followers/framatube.org/framasoft' => 'followers (account)',
            '/peertube/followers/framatube.org/framasoft/framablog.audio' => 'followers (channel)',
        ];
    }
}
