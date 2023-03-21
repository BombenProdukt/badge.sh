<?php

declare(strict_types=1);

namespace App\Badges\Spack\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Spack\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class VersionBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $packageName): array
    {
        return $this->renderVersion($this->client->version($packageName));
    }

    public function service(): string
    {
        return 'Spack';
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/spack/version/{packageName}',
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
            '/spack/version/adios2' => 'version',
        ];
    }
}
