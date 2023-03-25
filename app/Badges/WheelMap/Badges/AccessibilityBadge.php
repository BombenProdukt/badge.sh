<?php

declare(strict_types=1);

namespace App\Badges\WheelMap\Badges;

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
            '/wheelmap/accessibility/26699541' => 'version',
        ];
    }
}
