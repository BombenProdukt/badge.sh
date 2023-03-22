<?php

declare(strict_types=1);

namespace App\Badges\Polymart\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Polymart\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class VersionBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $resourceId): array
    {
        return $this->renderVersion($this->client->get($resourceId)['updates']['latest']['version']);
    }

    public function service(): string
    {
        return 'Polymart';
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/polymart/version/{resourceId}',
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
            '/polymart/version/323' => 'version',
        ];
    }
}
