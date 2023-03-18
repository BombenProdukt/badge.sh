<?php

declare(strict_types=1);

namespace App\Badges\PeerTube\Badges;

use App\Actions\FormatNumber;
use App\Badges\PeerTube\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

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
            '/peertube/{instance}/votes/{video}/{format?}',
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
            '/peertube/framatube.org/votes/9c9de5e8-0a1e-484a-b099-e80766180a6d'          => 'votes (combined)',
            '/peertube/framatube.org/votes/9c9de5e8-0a1e-484a-b099-e80766180a6d/likes'    => 'votes (likes)',
            '/peertube/framatube.org/votes/9c9de5e8-0a1e-484a-b099-e80766180a6d/dislikes' => 'votes (dislikes)',
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
