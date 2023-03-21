<?php

declare(strict_types=1);

namespace App\Badges\CDNJS\Badges;

use App\Badges\AbstractBadge;
use App\Badges\CDNJS\Client;
use App\Badges\Templates\VersionTemplate;
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
        return VersionTemplate::make($this->service(), $this->client->get($package));
    }

    public function service(): string
    {
        return 'cdnjs';
    }

    public function title(): string
    {
        return '';
    }

    public function keywords(): array
    {
        return [];
    }

    public function routePaths(): array
    {
        return [
            '/cdnjs/version/{package}',
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
            '/cdnjs/version/react' => 'version',
        ];
    }
}
