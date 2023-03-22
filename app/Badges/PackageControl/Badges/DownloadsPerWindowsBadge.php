<?php

declare(strict_types=1);

namespace App\Badges\PackageControl\Badges;

use App\Badges\AbstractBadge;
use App\Badges\PackageControl\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class DownloadsPerWindowsBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $packageName): array
    {
        return $this->renderDownloadsPerWindows($this->client->get($packageName)['installs']['windows']);
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
            '/package-control/downloads-windows/{packageName}',
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
            '/package-control/downloads-windows/GitGutter' => 'windows downloads',
        ];
    }
}
