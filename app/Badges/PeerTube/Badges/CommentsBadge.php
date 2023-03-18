<?php

declare(strict_types=1);

namespace App\Badges\PeerTube\Badges;

use App\Actions\FormatNumber;
use App\Badges\PeerTube\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class CommentsBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $instance, string $video): array
    {
        $response = $this->client->get($instance, "videos/{$video}/comment-threads");

        return [
            'label'       => 'comments',
            'status'      => FormatNumber::execute($response['total']),
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
            '/peertube/{instance}/comments/{video}',
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
            //
        ];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/peertube/framatube.org/comments/9c9de5e8-0a1e-484a-b099-e80766180a6d'       => 'comments',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
