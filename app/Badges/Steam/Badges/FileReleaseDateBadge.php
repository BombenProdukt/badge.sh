<?php

declare(strict_types=1);

namespace App\Badges\Steam\Badges;

use App\Enums\Category;

final class FileReleaseDateBadge extends AbstractBadge
{
    protected array $routes = [
        '/steam/file-release-date/{fileId}',
    ];

    protected array $keywords = [
        Category::ACTIVITY,
    ];

    public function handle(string $fileId): array
    {
        return [
            'date' => $this->client->file($fileId)['time_created'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderDateDiff('last modified', $properties['date']);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/steam/file-release-date/100' => 'file last modified',
        ];
    }
}
