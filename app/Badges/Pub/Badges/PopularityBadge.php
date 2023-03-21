<?php

declare(strict_types=1);

namespace App\Badges\Pub\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Pub\Client;
use App\Badges\Templates\PercentageTemplate;
use Illuminate\Routing\Route;

final class PopularityBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $package): array
    {
        $percentage = (float) $this->client->api("packages/{$package}/score")['popularityScore'];

        return PercentageTemplate::make('popularity', $percentage * 100);
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
        return [];
    }

    public function routePaths(): array
    {
        return [
            '/pub/popularity/{package}',
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
            '/pub/popularity/mobx' => 'popularity',
        ];
    }
}
