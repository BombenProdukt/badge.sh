<?php

declare(strict_types=1);

namespace App\Badges\WheelMap\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class AccessibilityBadge extends AbstractBadge
{
    protected array $routes = [
        '/wheelmap/accessibility/{nodeId}',
    ];

    protected array $keywords = [
        Category::OTHER,
    ];

    public function handle(string $nodeId): array
    {
        return [
            'accessibility' => $this->client->node($nodeId),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderText('accessibility', $properties['accessibility'], match ($properties['accessibility']) {
            'yes' => 'green.600',
            'limited' => 'yellow.600',
            'no' => 'red.600',
            default => 'gray.600',
        });
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'version',
                path: '/wheelmap/accessibility/26699541',
                data: $this->render(['accessibility' => 'yes']),
            ),
            new BadgePreviewData(
                name: 'version',
                path: '/wheelmap/accessibility/26699541',
                data: $this->render(['accessibility' => 'limited']),
            ),
            new BadgePreviewData(
                name: 'version',
                path: '/wheelmap/accessibility/26699541',
                data: $this->render(['accessibility' => 'no']),
            ),
        ];
    }
}
