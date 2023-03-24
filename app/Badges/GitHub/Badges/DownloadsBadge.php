<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Enums\Category;
use GrahamCampbell\GitHub\Facades\GitHub;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class DownloadsBadge extends AbstractBadge
{
    public function handle(string $owner, string $repo, ?string $tag = ''): array
    {
        $release = GitHub::api('repo')->releases()->show($owner, $repo, $tag ? "tags/{$tag}" : 'latest');

        if (! $release || ! $release['assets'] || ! count($release['assets'])) {
            return [
                'label'        => 'downloads',
                'message'      => 'no assets',
                'messageColor' => 'gray.600',
            ];
        }

        $downloadCount = array_reduce($release['assets'], function ($result, $asset) {
            return $result + $asset['download_count'];
        }, 0);

        return [
            'label'        => 'downloads',
            'message'      => FormatNumber::execute($downloadCount),
            'messageColor' => 'green.600',
        ];
    }

    public function keywords(): array
    {
        return [Category::DOWNLOADS];
    }

    public function routePaths(): array
    {
        return [
            '/github/downloads/{owner}/{repo}/{tag?}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        //
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/github/downloads/electron/electron'        => 'assets downloads for latest release',
            '/github/downloads/electron/electron/v7.0.0' => 'assets downloads for a tag',
        ];
    }
}
