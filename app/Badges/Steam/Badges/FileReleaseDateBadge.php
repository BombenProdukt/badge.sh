<?php

declare(strict_types=1);

namespace App\Badges\Steam\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Carbon\Carbon;

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

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'file last modified',
                path: '/steam/file-release-date/100',
                data: $this->render(['date' => Carbon::now()->unix()]),
            ),
        ];
    }
}
