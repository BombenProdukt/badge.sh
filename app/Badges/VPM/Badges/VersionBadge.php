<?php

declare(strict_types=1);

namespace App\Badges\VPM\Badges;

use App\Badges\AbstractBadge;
use App\Badges\VPM\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class VersionBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $packageId): array
    {
        return $this->renderVersion(array_key_last($this->client->versions($packageId)));
    }

    public function service(): string
    {
        return 'VPM';
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/vpm/version/{packageId}',
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
            '/vpm/version/com.vrchat.udonsharp' => 'version',
        ];
    }
}
