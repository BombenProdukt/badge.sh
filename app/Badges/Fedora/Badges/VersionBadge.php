<?php

declare(strict_types=1);

namespace App\Badges\Fedora\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Fedora\Client;
use Illuminate\Routing\Route;

final class VersionBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $packageName, ?string $branch = 'rawhide'): array
    {
        return $this->renderVersion($this->service(), $this->client->version($packageName, $branch));
    }

    public function service(): string
    {
        return 'Fedora';
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
            '/fedora/version/{packageName}/{branch?}',
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
            '/fedora/version/rpm'         => 'version',
            '/fedora/version/rpm/rawhide' => 'version',
        ];
    }
}
