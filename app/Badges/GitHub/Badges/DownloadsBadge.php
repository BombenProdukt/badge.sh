<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Badges\GitHub\Client;
use App\Contracts\Badge;
use GrahamCampbell\GitHub\Facades\GitHub;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class DownloadsBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $owner, string $repo, ?string $tag = ''): array
    {
        $release = GitHub::api('repo')->releases()->show($owner, $repo, $tag ? "tags/{$tag}" : 'latest');

        if (! $release || ! $release['assets'] || ! count($release['assets'])) {
            return [
                'label'       => 'downloads',
                'status'      => 'no assets',
                'statusColor' => 'gray.600',
            ];
        }

        $downloadCount = array_reduce($release['assets'], function ($result, $asset) {
            return $result + $asset['download_count'];
        }, 0);

        return [
            'label'       => 'downloads',
            'status'      => FormatNumber::execute($downloadCount),
            'statusColor' => 'green.600',
        ];
    }

    public function service(): string
    {
        return 'GitHub';
    }

    public function title(): string
    {
        return '';
    }

    public function keywords(): array
    {
        return [
            //
        ];
    }

    public function routePaths(): array
    {
        return [
            '/github/assets-dl/{owner}/{repo}/{tag?}',
        ];
    }

    public function routeParameters(): array
    {
        return [
            //
        ];
    }

    public function routeConstraints(Route $route): void
    {
        //
    }

    public function staticPreviews(): array
    {
        return [
            //
        ];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/github/assets-dl/electron/electron'        => 'assets downloads for latest release',
            '/github/assets-dl/electron/electron/v7.0.0' => 'assets downloads for a tag',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
