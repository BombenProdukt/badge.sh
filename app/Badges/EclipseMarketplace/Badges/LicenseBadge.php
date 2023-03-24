<?php

declare(strict_types=1);

namespace App\Badges\EclipseMarketplace\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class LicenseBadge extends AbstractBadge
{
    public function handle(string $name): array
    {
        return $this->renderLicense($this->client->get($name)->filterXPath('//license')->text());
    }

    public function keywords(): array
    {
        return [Category::LICENSE];
    }

    public function routePaths(): array
    {
        return [
            '/eclipse-marketplace/license/{name}',
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
            '/eclipse-marketplace/license/notepad4e' => 'license',
        ];
    }
}
