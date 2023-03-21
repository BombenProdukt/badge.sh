<?php

declare(strict_types=1);

namespace App\Badges\NPM\Badges;

use App\Badges\AbstractBadge;
use App\Badges\NPM\Client;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class NodeBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $package, string $tag = 'latest'): array
    {
        $response = $this->client->unpkg("{$package}@{$tag}/package.json");

        return [
            'label'        => 'node',
            'message'      => $response['engines']['node'],
            'messageColor' => 'green.600',
        ];
    }

    public function service(): string
    {
        return 'npm';
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
            '/npm/node-version/{package}/{tag?}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('package', RoutePattern::PACKAGE_WITH_SCOPE->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/npm/node-version/next' => 'node version',
        ];
    }
}
