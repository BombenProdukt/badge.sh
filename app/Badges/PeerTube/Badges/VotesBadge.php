<?php

declare(strict_types=1);

namespace App\Badges\PeerTube\Badges;

use App\Badges\PeerTube\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class VotesBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $instance, string $video, ?string $format = null): array
    {
        $response = $this->client->get($instance, "videos/{$video}");

        if ($format === 'likes') {
            return [
                'label'       => 'votes',
                'status'      => FormatNumber::execute($response['likes']),
                'statusColor' => 'F1680D',
            ];
        }

        if ($format === 'dislikes') {
            return [
                'label'       => 'votes',
                'status'      => FormatNumber::execute($response['dislikes']),
                'statusColor' => 'F1680D',
            ];
        }

        return [
            'label'       => 'votes',
            'status'      => sprintf('%s 👍 %s 👎', FormatNumber::execute($response['likes']), FormatNumber::execute($response['dislikes'])),
            'statusColor' => 'F1680D',
        ];
    }

    public function service(): string
    {
        return 'PeerTube';
    }

    public function title(): string
    {
        return '';
    }

    public function keywords(): array
    {
        return [
            //
        ];
    }

    public function routePaths(): array
    {
        return [
            '/peertube/{instance}/{video}/votes/{format?}',
        ];
    }

    public function routeParameters(): array
    {
        return [
            //
        ];
    }

    public function routeConstraints(Route $route): void
    {
        //
    }

    public function staticPreviews(): array
    {
        return [
            '/peertube/framatube.org/9c9de5e8-0a1e-484a-b099-e80766180a6d/votes'          => 'votes (combined)',
            // TODO: extract into a likes badge
            '/peertube/framatube.org/9c9de5e8-0a1e-484a-b099-e80766180a6d/votes/likes'    => 'votes (likes)',
            // TODO: extract into a dislikes badge
            '/peertube/framatube.org/9c9de5e8-0a1e-484a-b099-e80766180a6d/votes/dislikes' => 'votes (dislikes)',
        ];
    }

    public function dynamicPreviews(): array
    {
        return [
            //
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
