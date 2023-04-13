<?php

declare(strict_types=1);

namespace App\Badges\Testspace;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class PassedCountBadge extends AbstractBadge
{
    protected string $route = '/testspace/passed-count/{org}/{project}/{space}';

    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $org, string $project, string $space): array
    {
        return $this->client->get($org, $project, $space);
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('passed', $properties['passed'], 'green.600');
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'passed tests count',
                path: '/testspace/passed-count/swellaby/swellaby:testspace-sample/main',
                data: $this->render(['passed' => 1]),
            ),
        ];
    }
}
