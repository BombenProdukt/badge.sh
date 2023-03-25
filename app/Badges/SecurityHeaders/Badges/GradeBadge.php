<?php

declare(strict_types=1);

namespace App\Badges\SecurityHeaders\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class GradeBadge extends AbstractBadge
{
    protected array $routes = [
        '/security-headers/grade/{url}/',
    ];

    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $url): array
    {
        return [
            'grade' => $this->client->grade($url),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderGrade('security headers', $properties['grade']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'grade',
                path: '/security-headers/grade/shields.io',
                data: $this->render(['grade' => 'C']),
            ),
        ];
    }
}
