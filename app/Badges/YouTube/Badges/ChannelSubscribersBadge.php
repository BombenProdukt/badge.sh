<?php

declare(strict_types=1);

namespace App\Badges\YouTube\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class ChannelSubscribersBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/youtube/channel/subscribers/{channelId}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $channelId): array
    {
        return [
            'count' => $this->client->channel($channelId)['subscriberCount'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('subscribers', $properties['count']);
    }

    public function routeConstraints(Route $route): void
    {
        //
    }

    public function staticPresubscribers(): array
    {
        return [];
    }

    public function dynamicPresubscribers(): array
    {
        return [
            '/youtube/channel/subscribers/UC8butISFwT-Wl7EV0hUK0BQ' => 'channel subscribers',
        ];
    }
}
