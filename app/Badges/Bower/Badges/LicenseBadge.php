<?php

declare(strict_types=1);

namespace App\Badges\Bower\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Bower\Client;
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
        return $this->renderLicense($this->client->get($packageName)['normalized_licenses']);
    }

    public function service(): string
    {
        return 'Bower';
    }

    public function keywords(): array
    {
        return [Category::LICENSE];
    }

    public function routePaths(): array
    {
        return [
            '/bower/license/{packageName}',
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
            '/bower/license/bootstrap' => 'license',
        ];
    }
}
