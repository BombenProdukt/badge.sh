<?php

declare(strict_types=1);

namespace App\Badges\AppleMusic\Badges;

use App\Badges\AbstractBadge;
use App\Badges\AppleMusic\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class VersionBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $bundleId): array
    {
        return $this->renderVersion($this->client->version($bundleId));
    }

    public function service(): string
    {
        return 'Apple Music';
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/apple-music/version/{bundleId}',
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
            '/apple-music/version/803453959' => 'version',
        ];
    }
}
