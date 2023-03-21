<?php

declare(strict_types=1);

namespace App\Badges\WikiApiary\Badges;

use App\Badges\AbstractBadge;
use App\Badges\WikiApiary\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class InstallationsBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $variant, string $name): array
    {
        $results   = $this->client->usage($variant, $name);
        $resultKey = array_search("{$variant}:{$name}", array_map('strtolower', array_keys($results)), true);

        return $this->renderNumber('installations', $results[$resultKey]['printouts']['Has website count'][0]);
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
        return [Category::DOWNLOADS];
    }

    public function routePaths(): array
    {
        return [
            '/wikiapiary/installations/{variant}/{name}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->whereIn('variant', ['extension', 'skin', 'farm', 'generator', 'host']);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/wikiapiary/installations/extension/ParserFunctions' => 'installations',
        ];
    }
}
