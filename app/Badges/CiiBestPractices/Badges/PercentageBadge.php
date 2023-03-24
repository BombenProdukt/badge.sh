<?php

declare(strict_types=1);

namespace App\Badges\CiiBestPractices\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class PercentageBadge extends AbstractBadge
{
    public function handle(string $projectId): array
    {
        return [
            'percentage' => $this->client->get($projectId)['tiered_percentage'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderCoverage($properties['percentage'], 'cii');
    }

    public function keywords(): array
    {
        return [Category::ANALYSIS];
    }

    public function routePaths(): array
    {
        return [
            '/cii/percentage/{projectId}',
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
            '/cii/percentage/29' => 'percentage',
        ];
    }
}
