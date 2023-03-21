<?php

declare(strict_types=1);

namespace App\Badges\PeerTube\Badges;

use App\Badges\AbstractBadge;
use App\Badges\PeerTube\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class LikesBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $instance, string $video): array
    {
        $response = $this->client->get($instance, "videos/{$video}");

        return [
            'label'        => 'votes',
            'message'      => FormatNumber::execute($response['likes']),
            'messageColor' => 'F1680D',
        ];
    }

    public function service(): string
    {
        return 'PeerTube';
    }

    public function keywords(): array
    {
        return [Category::SOCIAL];
    }

    public function routePaths(): array
    {
        return [
            '/peertube/likes/{instance}/{video}',
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
            '/peertube/likes/framatube.org/9c9de5e8-0a1e-484a-b099-e80766180a6d'    => 'likes',
        ];
    }

    public function dynamicPreviews(): array
    {
        return [];
    }
}
