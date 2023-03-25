<?php

declare(strict_types=1);

namespace App\Badges\Testspace\Badges;

use App\Enums\Category;

final class ErroredCountBadge extends AbstractBadge
{
    protected array $routes = [
        '/testspace/errored-count/{org}/{project}/{space}',
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
        return $this->renderNumber('errored', $properties['errored']);
    }

    public function previews(): array
    {
        return [
            '/testspace/errored-count/swellaby/swellaby:testspace-sample/main' => 'errored tests count',
        ];
    }
}
