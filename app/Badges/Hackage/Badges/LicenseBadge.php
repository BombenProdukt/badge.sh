<?php

declare(strict_types=1);

namespace App\Badges\Hackage\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Hackage\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class LicenseBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $package): array
    {
        return $this->renderLicense($this->client->hackage($package)['license']);
    }

    public function service(): string
    {
        return 'Hackage';
    }

    public function keywords(): array
    {
        return [Category::LICENSE];
    }

    public function routePaths(): array
    {
        return [
            '/hackage/license/{package}',
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
            '/hackage/license/Cabal' => 'license',
        ];
    }
}
