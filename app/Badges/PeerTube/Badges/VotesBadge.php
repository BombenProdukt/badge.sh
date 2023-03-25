<?php

declare(strict_types=1);

namespace App\Badges\PeerTube\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class VotesBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/peertube/votes/{instance}/{video}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $instance, string $video): array
    {
        return $this->client->get($instance, "videos/{$video}");
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'votes',
            'message' => \sprintf('%s 👍 %s 👎', FormatNumber::execute($properties['likes']), FormatNumber::execute($properties['dislikes'])),
            'messageColor' => 'F1680D',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        //
    }

    public function staticPreviews(): array
    {
        return [
            '/peertube/votes/framatube.org/9c9de5e8-0a1e-484a-b099-e80766180a6d' => 'votes',
        ];
    }

    public function dynamicPreviews(): array
    {
        return [];
    }
}
