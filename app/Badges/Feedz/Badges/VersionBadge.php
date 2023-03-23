<?php

declare(strict_types=1);

namespace App\Badges\Feedz\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Feedz\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class VersionBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $organization, string $repository, string $packageName): array
    {
        return $this->renderVersion(head($this->client->items($organization, $repository, $packageName)));
    }

    public function service(): string
    {
        return 'Feedz';
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/feedz/version/{organization}/{repository}/{packageName}',
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
            '/feedz/version/shieldstests/mongodb/MongoDB.Driver.Core' => 'version',
        ];
    }
}
