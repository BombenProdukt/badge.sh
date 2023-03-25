<?php

declare(strict_types=1);

namespace App\Badges\SecurityHeaders\Badges;

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
            '/security-headers/grade/shields.io' => 'grade',
        ];
    }
}
