<?php

declare(strict_types=1);

namespace App\Badges\Treeware\Badges;

use App\Badges\Templates\NumberTemplate;
use App\Badges\Treeware\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class CountBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $owner, string $packageName): array
    {
        return NumberTemplate::make('trees', $this->client->get($owner, $packageName));
    }

    public function service(): string
    {
        return 'Treeware';
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
            '/treeware/trees/{owner}/{packageName}',
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
            '/treeware/trees/stoplightio/spectral' => 'tree count',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
