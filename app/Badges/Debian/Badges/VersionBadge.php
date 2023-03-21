<?php

declare(strict_types=1);

namespace App\Badges\Debian\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Debian\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class VersionBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $packageName, ?string $distribution = 'stable'): array
    {
        return $this->renderVersion(array_key_first($this->client->version($packageName, $distribution)));
    }

    public function service(): string
    {
        return 'Debian';
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/debian/version/{packageName}/{distribution?}',
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
            '/debian/version/apt'          => 'version',
            '/debian/version/apt/unstable' => 'version',
        ];
    }
}
