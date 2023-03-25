<?php

declare(strict_types=1);

namespace App\Badges\Haxelib\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class LatestDownloadsBadge extends AbstractBadge
{
    protected array $routes = [
        '/haxelib/downloads-recently/{project}',
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
        return [
            'label' => 'TODO',
            'message' => 'TODO',
            'messageColor' => 'TODO',
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'downloads (latest version)',
                path: '/haxelib/downloads-recently/hxnodejs',
                data: $this->render(['downloads' => '1000000']),
            ),
        ];
    }
}
