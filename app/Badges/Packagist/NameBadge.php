<?php

declare(strict_types=1);

namespace App\Badges\Packagist;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class NameBadge extends AbstractBadge
{
    protected string $route = '/packagist/name/{vendor}/{project}';

    protected array $keywords = [
        Category::OTHER,
    ];

    public function handle(string $vendor, string $project): array
    {
        return $this->client->get($vendor, $project);
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'packagist',
            'message' => $properties['name'],
            'messageColor' => 'green.600',
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'name',
                path: '/packagist/name/monolog/monolog',
                data: $this->render(['name' => 'monolog/monolog']),
            ),
        ];
    }
}
