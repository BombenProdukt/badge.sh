<?php

declare(strict_types=1);

namespace App\Badges\PeerTube\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class DislikesBadge extends AbstractBadge
{
    public function handle(string $instance, string $video): array
    {
        $response = $this->client->get($instance, "videos/{$video}");

        return [
            'label'        => 'votes',
            'message'      => FormatNumber::execute($response['dislikes']),
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
            '/peertube/dislikes/{instance}/{video}',
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
            '/peertube/dislikes/framatube.org/9c9de5e8-0a1e-484a-b099-e80766180a6d' => 'dislikes',
        ];
    }

    public function dynamicPreviews(): array
    {
        return [];
    }
}
