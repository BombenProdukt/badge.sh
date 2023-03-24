<?php

declare(strict_types=1);

namespace App\Badges\VaadinAddOnDirectory\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class StatusBadge extends AbstractBadge
{
    public function handle(string $packageName): array
    {
        return $this->client->get($packageName);
    }

    public function render(array $properties): array
    {
        return $this->renderText('status', $properties['status']);
    }

    public function keywords(): array
    {
        return [Category::OTHER];
    }

    public function routePaths(): array
    {
        return [
            '/vaadin/status/{packageName}',
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
            '/vaadin/status/vaadinvaadin-grid' => 'status',
        ];
    }
}
