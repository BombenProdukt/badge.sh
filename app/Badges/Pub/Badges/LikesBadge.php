<?php

declare(strict_types=1);

namespace App\Badges\Pub\Badges;

use App\Actions\FormatNumber;
use App\Badges\Pub\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class LikesBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $package): array
    {
        $likeCount = $this->client->api("packages/{$package}/score")['likeCount'];

        return [
            'label'       => 'popularity',
            'status'      => FormatNumber::execute($likeCount),
            'statusColor' => 'green.600',
        ];
    }

    public function service(): string
    {
        return 'Pub';
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
            '/pub/likes/{package}',
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
            '/pub/likes/firebase_core' => 'likes',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
