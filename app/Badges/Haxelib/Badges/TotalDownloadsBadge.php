<?php

declare(strict_types=1);

namespace App\Badges\Haxelib\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class TotalDownloadsBadge extends AbstractBadge
{
    protected array $routes = [
        '/haxelib/downloads/{project}',
    ];

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $project): array
    {
        return $this->client->get($project);
    }

    public function render(array $properties): array
    {
        return $this->renderDownloads(0);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'total downloads',
                path: '/haxelib/downloads/hxnodejs',
                data: $this->render(['downloads' => '1000000']),
            ),
        ];
    }
}
