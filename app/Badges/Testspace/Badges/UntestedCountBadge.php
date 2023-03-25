<?php

declare(strict_types=1);

namespace App\Badges\Testspace\Badges;

use App\Data\BadgePreviewData;
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

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'untested tests count',
                path: '/testspace/untested-count/swellaby/swellaby:testspace-sample/main',
                data: $this->render(['untested' => '5']),
            ),
        ];
    }
}
