<?php

declare(strict_types=1);

namespace App\Badges\CiiBestPractices\Badges;

use App\Actions\DetermineColorByStatus;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class SummaryBadge extends AbstractBadge
{
    public function handle(string $projectId): array
    {
        $response = $this->client->get($projectId);

        return [
            'level' => $response['badge_level'],
            'percentage' => $response['tiered_percentage'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderText('cii', match (true) {
            $properties['percentage'] < 100 => "in progress {$properties['percentage']}%",
            $properties['percentage'] < 200 => 'passing',
            $properties['percentage'] < 300 => 'silver',
            default => 'gold',
        }, DetermineColorByStatus::execute($properties['level']));
    }

    public function keywords(): array
    {
        return [Category::ANALYSIS];
    }

    public function routePaths(): array
    {
        return [
            '/cii/summary/{projectId}',
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
            '/cii/summary/33' => 'summary',
        ];
    }
}
