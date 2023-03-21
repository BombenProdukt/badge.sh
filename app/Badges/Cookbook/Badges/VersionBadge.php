<?php

declare(strict_types=1);

namespace App\Badges\Cookbook\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Cookbook\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class VersionBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $cookbook): array
    {
        return $this->renderVersion($this->client->version($cookbook));
    }

    public function service(): string
    {
        return 'Cookbook';
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
            '/cookbook/version/{cookbook}',
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
            '/cookbook/version/chef-sugar' => 'version',
        ];
    }
}
