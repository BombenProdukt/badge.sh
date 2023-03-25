<?php

declare(strict_types=1);

namespace App\Badges\Testspace\Badges;

use App\Enums\Category;

final class UntestedCountBadge extends AbstractBadge
{
    protected array $routes = [
        '/testspace/untested-count/{org}/{project}/{space}',
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
        return $this->renderNumber('untested', $properties['untested'], 'orange.600');
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/testspace/untested-count/swellaby/swellaby:testspace-sample/main' => 'untested tests count',
        ];
    }
}
