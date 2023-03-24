<?php

declare(strict_types=1);

namespace App\Badges\PackageControl\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class LastModifiedBadge extends AbstractBadge
{
    public function handle(string $packageName): array
    {
        return [
            'date' => $this->client->get($packageName)['last_modified'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderDateDiff('last modified', $properties['date']);
    }

    public function keywords(): array
    {
        return [Category::LICENSE];
    }

    public function routePaths(): array
    {
        return [
            '/package-control/last-modified/{packageName}',
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
            '/package-control/last-modified/GitGutter' => 'last modified',
        ];
    }
}
