<?php

declare(strict_types=1);

namespace App\Badges\WikiApiary\Badges;

use App\Badges\Templates\NumberTemplate;
use App\Badges\WikiApiary\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class InstallationsBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $variant, string $name): array
    {
        $results   = $this->client->usage($variant, $name);
        $resultKey = array_search("{$variant}:{$name}", array_map('strtolower', array_keys($results)), true);

        return NumberTemplate::make('installations', $results[$resultKey]['printouts']['Has website count'][0]);
    }

    public function service(): string
    {
        return 'WikiApiary';
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
            '/wikiapiary/installations/{variant}/{name}',
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
        $route->whereIn('variant', ['extension', 'skin', 'farm', 'generator', 'host']);
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
            '/wikiapiary/installations/extension/ParserFunctions' => 'installations',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
