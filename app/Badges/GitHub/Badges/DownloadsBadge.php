<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Enums\Category;
use GrahamCampbell\GitHub\Facades\GitHub;

final class DownloadsBadge extends AbstractBadge
{
    protected array $routes = [
        '/github/downloads/{owner}/{repo}/{tag?}',
    ];

    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $owner, string $repo, ?string $tag = ''): array
    {
        $release = GitHub::api('repo')->releases()->show($owner, $repo, $tag ? "tags/{$tag}" : 'latest');

        if (!$release || !$release['assets'] || !\count($release['assets'])) {
            return [
                'label' => 'downloads',
                'message' => 'no assets',
                'messageColor' => 'gray.600',
            ];
        }

        $downloadCount = \array_reduce($release['assets'], function ($result, $asset) {
            return $result + $asset['download_count'];
        }, 0);

        return [
            'downloads' => $downloadCount,
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderDownloads($properties['downloads']);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/github/downloads/electron/electron' => 'assets downloads for latest release',
            '/github/downloads/electron/electron/v7.0.0' => 'assets downloads for a tag',
        ];
    }
}
