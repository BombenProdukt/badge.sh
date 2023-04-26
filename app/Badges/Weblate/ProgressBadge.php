<?php

declare(strict_types=1);

namespace App\Badges\Weblate;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class ProgressBadge extends AbstractBadge
{
    protected string $route = '/weblate/progress/{project}';

    protected array $keywords = [
        Category::METRICS,
    ];

    public function handle(string $project): array
    {
        return [
            'percentage' => $this->client->project($project)['translated_percent'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderPercentage('progress', $properties['percentage']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'progress',
                path: '/weblate/progress/godot-engine',
                data: $this->render(['percentage' => 0]),
            ),
        ];
    }
}
