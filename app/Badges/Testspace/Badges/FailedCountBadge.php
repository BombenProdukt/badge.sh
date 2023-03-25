<?php

declare(strict_types=1);

namespace App\Badges\Testspace\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class FailedCountBadge extends AbstractBadge
{
    protected array $routes = [
        '/testspace/failed-count/{org}/{project}/{space}',
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
        return $this->renderNumber('failed', $properties['failed']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'failed tests count',
                path: '/testspace/failed-count/swellaby/swellaby:testspace-sample/main',
                data: $this->render([]),
            ),
        ];
    }
}
