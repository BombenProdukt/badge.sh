<?php

declare(strict_types=1);

namespace App\Badges\SecurityHeaders\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class GradeBadge extends AbstractBadge
{
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

    public function keywords(): array
    {
        return [Category::ANALYSIS];
    }

    public function routePaths(): array
    {
        return [
            '/security-headers/grade/{url}/',
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
            '/security-headers/grade/shields.io' => 'grade',
        ];
    }
}
