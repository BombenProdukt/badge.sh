<?php

declare(strict_types=1);

namespace App\Badges\Haxelib\Badges;

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

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/haxelib/downloads-recently/hxnodejs' => 'downloads (latest version)',
        ];
    }
}
