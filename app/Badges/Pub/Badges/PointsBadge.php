<?php

declare(strict_types=1);

namespace App\Badges\Pub\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class PointsBadge extends AbstractBadge
{
    public function handle(string $package): array
    {
        $response = $this->client->api("packages/{$package}/score");

        return [
            'label'        => 'popularity',
            'message'      => $response['grantedPoints'].'/'.$response['maxPoints'],
            'messageColor' => 'green.600',
        ];
    }

    public function keywords(): array
    {
        return [Category::SOCIAL];
    }

    public function routePaths(): array
    {
        return [
            '/pub/points/{package}',
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
            '/pub/points/rxdart' => 'pub points',
        ];
    }
}
