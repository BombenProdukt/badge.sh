<?php

declare(strict_types=1);

namespace App\Badges\OpenVSX\Badges;

use App\Badges\AbstractBadge;
use App\Badges\OpenVSX\Client;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class RatingBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $extension): array
    {
        $response = $this->client->get($extension);

        return [
            'label'        => 'rating',
            'message'      => $response['averageRating'].'/5',
            'messageColor' => 'green.600',
        ];
    }

    public function service(): string
    {
        return 'Open VSX';
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
            '/open-vsx/rating/{extension}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('extension', RoutePattern::CATCH_ALL->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/open-vsx/rating/idleberg/electron-builder' => 'rating',
        ];
    }
}
