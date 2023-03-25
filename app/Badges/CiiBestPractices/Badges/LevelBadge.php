<?php

declare(strict_types=1);

namespace App\Badges\CiiBestPractices\Badges;

use App\Actions\DetermineColorByStatus;
use App\Enums\Category;

final class LevelBadge extends AbstractBadge
{
    protected array $routes = [
        '/cii/level/{projectId}',
    ];

    protected array $keywords = [
        Category::ANALYSIS,
    ];

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

    public function previews(): array
    {
        return [
            '/cii/level/1' => 'level',
        ];
    }
}
