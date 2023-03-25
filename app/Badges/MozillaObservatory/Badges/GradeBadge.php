<?php

declare(strict_types=1);

namespace App\Badges\MozillaObservatory\Badges;

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

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/mozilla-observatory/grade/github.com' => 'grade',
        ];
    }
}
