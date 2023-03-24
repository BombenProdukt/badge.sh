<?php

declare(strict_types=1);

namespace App\Badges\EclipseMarketplace\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class VersionBadge extends AbstractBadge
{
    public function handle(string $name): array
    {
        return [
            'version' => $this->client->get($name)->filterXPath('//version')->text(),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version']);
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/eclipse-marketplace/version/{name}',
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
            '/eclipse-marketplace/version/notepad4e' => 'version',
        ];
    }
}
