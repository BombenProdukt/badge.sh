<?php

declare(strict_types=1);

namespace App\Badges\Packagist;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class DependentsBadge extends AbstractBadge
{
    protected string $route = '/packagist/dependents/{vendor}/{project}';

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $vendor, string $project): array
    {
        return $this->client->get($vendor, $project);
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('dependents', $properties['dependents']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'dependents',
                path: '/packagist/dependents/monolog/monolog',
                data: $this->render(['dependents' => 1000000000]),
            ),
        ];
    }
}
