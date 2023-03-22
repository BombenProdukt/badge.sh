<?php

declare(strict_types=1);

namespace App\Badges\Conan\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Conan\Client;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class VersionBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $packageName): array
    {
        return $this->renderVersion(array_key_first($this->client->get($packageName)['versions']));
    }

    public function service(): string
    {
        return 'Conan Center';
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/conan/version/{packageName}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('packageName', RoutePattern::CATCH_ALL->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/conan/version/boost' => 'version',
        ];
    }
}
