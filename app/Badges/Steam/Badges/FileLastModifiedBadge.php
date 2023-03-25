<?php

declare(strict_types=1);

namespace App\Badges\Steam\Badges;

use App\Enums\Category;

final class FileLastModifiedBadge extends AbstractBadge
{
    protected array $routes = [
        '/steam/file-last-modified/{fileId}',
    ];

    protected array $keywords = [
        Category::ACTIVITY,
    ];

    public function handle(string $fileId): array
    {
        return [
            'date' => $this->client->file($fileId)['time_updated'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderDateDiff('last modified', $properties['data']);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/steam/file-last-modified/100' => 'file last modified',
        ];
    }
}
