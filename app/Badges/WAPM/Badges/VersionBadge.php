<?php

declare(strict_types=1);

namespace App\Badges\WAPM\Badges;

use App\Badges\AbstractBadge;
use App\Badges\WAPM\Client;
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
        $response = $this->client->get($package);

        return $this->renderVersion($response['version']);
    }

    public function service(): string
    {
        return 'WebAssembly Package Manager';
    }

    public function title(): string
    {
        return '';
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/wapm/version/{package}',
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
            '/wapm/version/zamfofex/greg' => 'version',
            '/wapm/version/cowsay'        => 'version',
        ];
    }
}
