<?php

declare(strict_types=1);

namespace App\Badges\PeerTube\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class VotesBadge extends AbstractBadge
{
    public function handle(string $instance, string $video): array
    {
        return $this->client->get($instance, "videos/{$video}");
    }

    public function render(array $properties): array
    {
        return [
            'label'        => 'votes',
            'message'      => sprintf('%s 👍 %s 👎', FormatNumber::execute($properties['likes']), FormatNumber::execute($properties['dislikes'])),
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
            '/peertube/votes/{instance}/{video}',
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
