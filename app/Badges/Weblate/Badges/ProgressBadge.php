<?php

declare(strict_types=1);

namespace App\Badges\Weblate\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class ProgressBadge extends AbstractBadge
{
    public function handle(string $project): array
    {
        return $this->renderPercentage('progress', $this->client->project($project)['translated_percent']);
    }

    public function keywords(): array
    {
        return [Category::METRICS];
    }

    public function routePaths(): array
    {
        return [
            '/weblate/progress/{project}',
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
            '/weblate/progress/godot-engine' => 'progress',
        ];
    }
}
