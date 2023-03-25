<?php

declare(strict_types=1);

namespace App\Badges\Testspace\Badges;

use App\Enums\Category;

final class TotalCountBadge extends AbstractBadge
{
    protected array $routes = [
        '/testspace/total-count/{org}/{project}/{space}',
    ];

    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $org, string $project, string $space): array
    {
        return [
            'downloads' => $this->client->get($org, $project, $space)['total'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('total', $properties['downloads']);
    }

    public function previews(): array
    {
        return [
            '/testspace/total-count/swellaby/swellaby:testspace-sample/main' => 'total tests count',
        ];
    }
}
