<?php

declare(strict_types=1);

namespace App\Badges\Liberapay\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class PatronsBadge extends AbstractBadge
{
    public function handle(string $username): array
    {
        return [
            'count' => $this->client->get($username)['npatrons'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('patrons', $properties['count']);
    }

    public function keywords(): array
    {
        return [Category::FUNDING];
    }

    public function routePaths(): array
    {
        return [
            '/liberapay/patrons/{username}',
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
            '/liberapay/patrons/microG' => 'patrons count',
        ];
    }
}
