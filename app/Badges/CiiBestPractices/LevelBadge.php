<?php

declare(strict_types=1);

namespace App\Badges\CiiBestPractices;

use App\Actions\DetermineColorByStatus;
use App\Data\BadgePreviewData;
use App\Enums\Category;

final class LevelBadge extends AbstractBadge
{
    protected string $route = '/cii/level/{projectId}';

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
            new BadgePreviewData(
                name: 'level',
                path: '/cii/level/1',
                data: $this->render(['level' => 'silver']),
            ),
        ];
    }
}
