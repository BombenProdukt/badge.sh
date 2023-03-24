<?php

declare(strict_types=1);

namespace App\Badges\Ecologi\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class CarbonBadge extends AbstractBadge
{
    public function handle(string $username): array
    {
        return $this->renderNumber('carbon offset', $this->client->carbon($username));
    }

    public function keywords(): array
    {
        return [Category::OTHER];
    }

    public function routePaths(): array
    {
        return [
            '/ecologi/carbon/{username}',
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
            '/ecologi/carbon/ecologi' => 'license',
        ];
    }
}
