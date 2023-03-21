<?php

declare(strict_types=1);

namespace App\Badges\WinGet\Badges;

use App\Badges\AbstractBadge;
use App\Badges\WinGet\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class VersionBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $appId): array
    {
        return $this->renderVersion($this->client->version($appId));
    }

    public function service(): string
    {
        return 'winget';
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/winget/version/{appId}',
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
            '/winget/version/GitHub.cli'    => 'version',
            '/winget/version/Balena.Etcher' => 'version',
        ];
    }
}
