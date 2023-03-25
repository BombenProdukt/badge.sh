<?php

declare(strict_types=1);

namespace App\Badges\Testspace\Badges;

use App\Enums\Category;

final class SkippedCountBadge extends AbstractBadge
{
    protected array $routes = [
        '/testspace/skipped-count/{org}/{project}/{space}',
    ];

    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $org, string $project, string $space): array
    {
        return $this->client->get($org, $project, $space);
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('skipped', $properties['skipped'], 'yellow.600');
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/testspace/skipped-count/swellaby/swellaby:testspace-sample/main' => 'skipped tests count',
        ];
    }
}
