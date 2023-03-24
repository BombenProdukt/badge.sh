<?php

declare(strict_types=1);

namespace App\Badges\DUB\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class LicenseBadge extends AbstractBadge
{
    public function handle(string $package): array
    {
        return $this->client->get("{$package}/latest/info")['info'];
    }

    public function render(array $properties): array
    {
        return $this->renderLicense($properties['license']);
    }

    public function keywords(): array
    {
        return [Category::LICENSE];
    }

    public function routePaths(): array
    {
        return [
            '/dub/license/{package}',
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
            '/dub/license/arsd-official' => 'license',
        ];
    }
}
