<?php

declare(strict_types=1);

namespace App\Badges\NPMS\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class FinalScoreBadge extends AbstractBadge
{
    protected array $routes = [
        '/npms/final-score/{package}',
    ];

    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $package): array
    {
        return [
            'score' => $this->client->get($package)['final'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('score', $properties['score']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'final score',
                path: '/npms/final-score/chalk',
                data: $this->render(['score' => '4.5']),
            ),
        ];
    }
}
