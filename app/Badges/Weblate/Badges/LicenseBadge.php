<?php

declare(strict_types=1);

namespace App\Badges\Weblate\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class LicenseBadge extends AbstractBadge
{
    public function handle(string $project, string $component): array
    {
        return $this->renderLicense($this->client->component($project, $component)['license']);
    }

    public function keywords(): array
    {
        return [Category::LICENSE];
    }

    public function routePaths(): array
    {
        return [
            '/weblate/license/{project}/{component}',
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
            '/weblate/license/godot-engine/godot' => '',
        ];
    }
}
