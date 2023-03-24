<?php

declare(strict_types=1);

namespace App\Badges\VaadinAddOnDirectory\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class ReleaseDateBadge extends AbstractBadge
{
    public function handle(string $packageName): array
    {
        return $this->renderDate('release date', $this->client->get($packageName)['latestAvailableRelease']['publicationDate']);
    }

    public function keywords(): array
    {
        return [Category::ACTIVITY];
    }

    public function routePaths(): array
    {
        return [
            '/vaadin/release-date/{packageName}',
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
            '/vaadin/release-date/vaadinvaadin-grid' => 'release date',
        ];
    }
}
