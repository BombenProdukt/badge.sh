<?php

declare(strict_types=1);

namespace App\Badges\DUB\Badges;

use App\Badges\DUB\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class RatingBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $package): array
    {
        $score = $this->client->get("{$package}/stats")['score'];

        return [
            'label'       => 'rating',
            'status'      => number_format($score / 5, 2),
            'statusColor' => 'green.600',
        ];
    }

    public function service(): string
    {
        return 'DUB';
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
            '/dub/rating/{package}',
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
            '/dub/rating/pegged' => 'rating',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
