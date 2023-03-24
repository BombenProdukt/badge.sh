<?php

declare(strict_types=1);

namespace App\Badges\CiiBestPractices\Badges;

use App\Actions\DetermineColorByStatus;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class LevelBadge extends AbstractBadge
{
    public function handle(string $projectId): array
    {
        return [
            'level' => $this->client->get($projectId)['badge_level'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderText('cii', $properties['level'], DetermineColorByStatus::execute($properties['level']));
    }

    public function keywords(): array
    {
        return [Category::ANALYSIS];
    }

    public function routePaths(): array
    {
        return [
            '/cii/level/{projectId}',
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
            '/cii/level/1' => 'level',
        ];
    }
}
