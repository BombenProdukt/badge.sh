<?php

declare(strict_types=1);

namespace App\Badges\GitHub;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use GrahamCampbell\GitHub\Facades\GitHub;

final class DownloadsBadge extends AbstractBadge
{
    protected string $route = '/github/downloads/{owner}/{repo}/{tag?}';

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

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'assets downloads for latest release',
                path: '/github/downloads/electron/electron',
                data: $this->render(['downloads' => '1000000']),
            ),
            new BadgePreviewData(
                name: 'assets downloads for a tag',
                path: '/github/downloads/electron/electron/v7.0.0',
                data: $this->render(['downloads' => '1000000']),
            ),
        ];
    }
}
