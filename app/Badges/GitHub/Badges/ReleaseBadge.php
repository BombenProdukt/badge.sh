<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Actions\ExtractVersion;
use App\Enums\Category;
use GrahamCampbell\GitHub\Facades\GitHub;
use Illuminate\Routing\Route;

final class ReleaseBadge extends AbstractBadge
{
    public function handle(string $owner, string $repo, ?string $channel = 'stable'): array
    {
        $releases = GitHub::api('repo')->releases()->all($owner, $repo);

        if (empty($releases)) {
            return [
                'label'        => 'release',
                'message'      => 'none',
                'messageColor' => 'yellow.600',
            ];
        }

        if ($channel === 'stable') {
            $stable = collect($releases)->firstWhere('prerelease', false);

            return [
                'label'        => 'release',
                'message'      => ExtractVersion::execute($stable['name'] ?: $stable['tag_name']),
                'messageColor' => 'blue.600',
            ];
        }

        return [
            'label'        => 'release',
            'message'      => ExtractVersion::execute($releases[0]['name'] ?? $releases[0]['tag_name']),
            'messageColor' => $releases[0]['prerelease'] ? 'orange.600' : 'blue.600',
        ];
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/github/release/{owner}/{repo}/{channel?}',
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
            '/github/release/babel/babel'        => 'stable release',
            '/github/release/babel/babel/latest' => 'latest release',
            '/github/release/babel/babel/stable' => 'latest stable release',
        ];
    }
}
