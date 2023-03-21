<?php

declare(strict_types=1);

namespace App\Badges\PeerTube\Badges;

use App\Badges\AbstractBadge;
use App\Badges\PeerTube\Client;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class CommentsBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $instance, string $video): array
    {
        $response = $this->client->get($instance, "videos/{$video}/comment-threads");

        return [
            'label'        => 'comments',
            'message'      => FormatNumber::execute($response['total']),
            'messageColor' => 'F1680D',
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
        return [];
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
