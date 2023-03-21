<?php

declare(strict_types=1);

namespace App\Badges\Repology\Badges;

use App\Badges\Repology\Client;
use App\Badges\Templates\NumberTemplate;
use App\Contracts\Badge;
use Illuminate\Routing\Route;
use Spatie\Regex\Regex;

final class RepositoryCountBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $packageName): array
    {
        return NumberTemplate::make(
            'repositories',
            Regex::match('|<text x="105.0" y="15" fill="#010101" fill-opacity=".3" text-anchor="middle">(\d+)</text>|', $this->client->count($packageName))->group(1),
        );
    }

    public function service(): string
    {
        return 'Repology';
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
            '/repology/repositories/{packageName}',
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
            '/repology/repositories/starship' => 'repository count',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
