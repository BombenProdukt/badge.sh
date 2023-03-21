<?php

declare(strict_types=1);

namespace App\Badges\JSDelivr\Badges;

use App\Badges\AbstractBadge;
use App\Badges\JSDelivr\Client;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class VersionBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $package): array
    {
        $version = $this->client->cdn($package)['version'];

        return $this->renderVersion($version);
    }

    public function service(): string
    {
        return 'jsDelivr';
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/jsdelivr/version/npm/{package}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('package', RoutePattern::CATCH_ALL->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/jsdelivr/version/npm/lodash' => 'version',
        ];
    }
}
