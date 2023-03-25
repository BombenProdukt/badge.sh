<?php

declare(strict_types=1);

namespace App\Badges\CiiBestPractices\Badges;

use App\Enums\Category;

final class PercentageBadge extends AbstractBadge
{
    protected array $routes = [
        '/cii/percentage/{projectId}',
    ];

    protected array $keywords = [
        Category::ANALYSIS,
    ];

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
