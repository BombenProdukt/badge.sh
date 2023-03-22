<?php

declare(strict_types=1);

namespace App\Badges\PackageControl\Badges;

use App\Badges\AbstractBadge;
use App\Badges\PackageControl\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class PlatformsBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $packageName): array
    {
        return $this->renderText('platforms', implode(' | ', $this->client->get($packageName)['platforms']), 'blue.600');
    }

    public function service(): string
    {
        return 'Package Control';
    }

    public function keywords(): array
    {
        return [Category::LICENSE];
    }

    public function routePaths(): array
    {
        return [
            '/package-control/downloads/{packageName}',
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
            '/package-control/downloads/GitGutter' => 'total downloads',
        ];
    }
}
