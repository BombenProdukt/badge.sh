<?php

declare(strict_types=1);

namespace App\Badges\CiiBestPractices\Badges;

use App\Actions\DetermineColorByStatus;
use App\Enums\Category;

final class SummaryBadge extends AbstractBadge
{
    protected array $routes = [
        '/cii/summary/{projectId}',
    ];

    protected array $keywords = [
        Category::ANALYSIS,
    ];

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
