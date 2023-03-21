<?php

declare(strict_types=1);

namespace App\Badges\HexPM\Badges;

use App\Badges\AbstractBadge;
use App\Badges\HexPM\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class LicenseBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $packageName): array
    {
        return $this->renderLicense($this->client->get($packageName)['meta']['licenses']);
    }

    public function service(): string
    {
        return 'hex.pm';
    }

    public function keywords(): array
    {
        return [Category::LICENSE];
    }

    public function routePaths(): array
    {
        return [
            '/hex/l/{packageName}',
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
            '/hex/l/plug' => 'license',
        ];
    }
}
