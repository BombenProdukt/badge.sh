<?php

declare(strict_types=1);

namespace App\Badges\YouTube\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class ChannelVideosBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/youtube/channel/videos/{channelId}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::LICENSE,
    ];

    public function handle(string $channelId): array
    {
        return [
            'count' => $this->client->channel($channelId)['videoCount'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('videos', $properties['count']);
    }

    public function routeConstraints(Route $route): void
    {
        //
    }

    public function staticPrevideos(): array
    {
        return [];
    }

    public function dynamicPrevideos(): array
    {
        return [
            '/youtube/channel/videos/UC8butISFwT-Wl7EV0hUK0BQ' => 'channel videos',
        ];
    }
}
