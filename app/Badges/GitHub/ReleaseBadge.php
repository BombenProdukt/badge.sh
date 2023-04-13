<?php

declare(strict_types=1);

namespace App\Badges\GitHub;

use App\Actions\ExtractVersion;
use App\Data\BadgePreviewData;
use App\Enums\Category;
use GrahamCampbell\GitHub\Facades\GitHub;

final class ReleaseBadge extends AbstractBadge
{
    protected string $route = '/github/release/{owner}/{repo}/{channel?}';

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

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'stable release',
                path: '/github/release/babel/babel',
                data: $this->render(['name' => '1.0.0', 'preRelease' => true]),
            ),
            new BadgePreviewData(
                name: 'latest release',
                path: '/github/release/babel/babel/latest',
                data: $this->render(['name' => '1.0.0', 'preRelease' => false]),
            ),
            new BadgePreviewData(
                name: 'latest stable release',
                path: '/github/release/babel/babel/stable',
                data: $this->render(['name' => '1.0.0', 'preRelease' => false]),
            ),
        ];
    }
}
