<?php

declare(strict_types=1);

namespace App\Badges\PackagePhobia\Badges;

use App\Badges\AbstractBadge;
use App\Badges\PackagePhobia\Client;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class InstallBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $name): array
    {
        $response = $this->client->get($name);

        return [
            'label'        => 'install size',
            'message'      => $response['install']['pretty'],
            'messageColor' => str_replace('#', '', $response['install']['color']),
        ];
    }

    public function service(): string
    {
        return 'Package Phobia';
    }

    public function title(): string
    {
        return '';
    }

    public function keywords(): array
    {
        return [Category::SIZE];
    }

    public function routePaths(): array
    {
        return [
            '/packagephobia/size/{name}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('name', RoutePattern::CATCH_ALL->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/packagephobia/size/webpack'               => 'install size',
            '/packagephobia/size/@tusbar/cache-control' => 'install size',
        ];
    }
}
