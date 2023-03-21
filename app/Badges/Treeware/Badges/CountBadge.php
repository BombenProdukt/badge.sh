<?php

declare(strict_types=1);

namespace App\Badges\Treeware\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Treeware\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class CountBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $owner, string $packageName): array
    {
        return $this->renderNumber('trees', $this->client->get($owner, $packageName));
    }

    public function service(): string
    {
        return 'Treeware';
    }

    public function keywords(): array
    {
        return [Category::OTHER];
    }

    public function routePaths(): array
    {
        return [
            '/treeware/trees/{owner}/{packageName}',
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
            '/treeware/trees/stoplightio/spectral' => 'tree count',
        ];
    }
}
