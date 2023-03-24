<?php

declare(strict_types=1);

namespace App\Badges\WheelMap\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class AccessibilityBadge extends AbstractBadge
{
    public function handle(string $nodeId): array
    {
        return [
            'accessibility' => $this->client->node($nodeId),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderText('accessibility', $properties['accessibility'], match ($properties['accessibility']) {
            'yes'     => 'green.600',
            'limited' => 'yellow.600',
            'no'      => 'red.600',
            default   => 'gray.600',
        });
    }

    public function keywords(): array
    {
        return [Category::OTHER];
    }

    public function routePaths(): array
    {
        return [
            '/wheelmap/accessibility/{nodeId}',
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
            '/wheelmap/accessibility/26699541' => 'version',
        ];
    }
}
