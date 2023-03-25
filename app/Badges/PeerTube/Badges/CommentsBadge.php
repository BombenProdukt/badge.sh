<?php

declare(strict_types=1);

namespace App\Badges\PeerTube\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class CommentsBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/peertube/comments/{instance}/{video}',
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
        return [
            'count' => $this->client->get($instance, "videos/{$video}/comment-threads")['total'],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'comments',
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
            '/peertube/comments/framatube.org/9c9de5e8-0a1e-484a-b099-e80766180a6d' => 'comments',
        ];
    }
}
