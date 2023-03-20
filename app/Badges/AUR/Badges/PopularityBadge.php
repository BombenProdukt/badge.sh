<?php

declare(strict_types=1);

namespace App\Badges\AUR\Badges;

use App\Badges\AUR\Client;
use App\Badges\Templates\NumberTemplate;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class PopularityBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $package): array
    {
        return NumberTemplate::make('popularity', $this->client->get($package)['Popularity']);
    }

    public function service(): string
    {
        return 'AUR';
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
            '/aur/{package}/popularity',
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
            '/aur/google-chrome/popularity' => 'popularity',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
