<?php

declare(strict_types=1);

namespace App\Badges\PeerTube\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class CommentsBadge extends AbstractBadge
{
    public function handle(string $instance, string $video): array
    {
        return [
            'count' => $this->client->get($instance, "videos/{$video}/comment-threads")['total'],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label'        => 'comments',
            'message'      => FormatNumber::execute($properties['count']),
            'messageColor' => 'F1680D',
        ];
    }

    public function keywords(): array
    {
        return [Category::SOCIAL];
    }

    public function routePaths(): array
    {
        return [
            '/peertube/comments/{instance}/{video}',
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
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/peertube/comments/framatube.org/9c9de5e8-0a1e-484a-b099-e80766180a6d'       => 'comments',
        ];
    }
}
