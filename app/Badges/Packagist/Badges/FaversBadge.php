<?php

declare(strict_types=1);

namespace App\Badges\Packagist\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class FaversBadge extends AbstractBadge
{
    protected string $route = '/packagist/favers/{vendor}/{project}';

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $vendor, string $project): array
    {
        return $this->client->get($vendor, $project);
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('favers', $properties['favers']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'favers',
                path: '/packagist/favers/monolog/monolog',
                data: $this->render(['favers' => 1000000000]),
            ),
        ];
    }
}
