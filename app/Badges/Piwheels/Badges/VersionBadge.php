<?php

declare(strict_types=1);

namespace App\Badges\Piwheels\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Piwheels\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class VersionBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $wheel): array
    {
        return $this->renderVersion(array_key_first($this->client->get($wheel)['releases']));
    }

    public function service(): string
    {
        return 'piwheels';
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/piwheels/version/{wheel}',
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
            '/piwheels/version/numpy' => 'version',
        ];
    }
}
