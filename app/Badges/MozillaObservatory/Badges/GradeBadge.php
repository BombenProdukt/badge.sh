<?php

declare(strict_types=1);

namespace App\Badges\MozillaObservatory\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class GradeBadge extends AbstractBadge
{
    protected array $routes = [
        '/mozilla-observatory/grade/{host}',
    ];

    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $host): array
    {
        return $this->client->get($host);
    }

    public function render(array $properties): array
    {
        return $this->renderGrade('observatory', $properties['grade']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'grade',
                path: '/mozilla-observatory/grade/github.com',
                data: $this->render(['grade' => 'C']),
            ),
        ];
    }
}
