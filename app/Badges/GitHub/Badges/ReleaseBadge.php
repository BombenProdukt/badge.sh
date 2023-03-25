<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Actions\ExtractVersion;
use App\Enums\Category;
use GrahamCampbell\GitHub\Facades\GitHub;
use Illuminate\Routing\Route;

final class ReleaseBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/github/release/{owner}/{repo}/{channel?}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $owner, string $repo, ?string $channel = 'stable'): array
    {
        $releases = GitHub::api('repo')->releases()->all($owner, $repo);

        if (empty($releases)) {
            return [];
        }

        if ($channel === 'stable') {
            $stable = collect($releases)->firstWhere('prerelease', false);

            return [
                'name' => $stable['name'],
                'tagName' => $stable['tag_name'],
                'prerelease' => $stable['prerelease'],
            ];
        }

        return [
            'name' => $releases[0]['name'],
            'tagName' => $releases[0]['tag_name'],
            'prerelease' => $releases[0]['prerelease'],
        ];
    }

    public function render(array $properties): array
    {
        if (empty($properties['name'])) {
            return [
                'label' => 'release',
                'message' => 'none',
                'messageColor' => 'yellow.600',
            ];
        }

        return [
            'label' => 'release',
            'message' => ExtractVersion::execute($properties['name'] ?? $properties['tagName']),
            'messageColor' => $properties['preRelease'] ? 'orange.600' : 'blue.600',
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
            '/github/release/babel/babel' => 'stable release',
            '/github/release/babel/babel/latest' => 'latest release',
            '/github/release/babel/babel/stable' => 'latest stable release',
        ];
    }
}
