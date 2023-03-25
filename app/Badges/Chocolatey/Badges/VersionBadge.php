<?php

declare(strict_types=1);

namespace App\Badges\Chocolatey\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected array $routes = [
        '/chocolatey/version/{project}/{channel?}',
    ];

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $project, ?string $channel = 'latest'): array
    {
        return [
            'version' => $this->client->get($project, $channel !== 'latest')['Version'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'version (stable channel)',
                path: '/chocolatey/version/git',
                data: $this->render([]),
            ),
            new BadgePreviewData(
                name: 'version (pre channel)',
                path: '/chocolatey/version/git/pre',
                data: $this->render([]),
            ),
            new BadgePreviewData(
                name: 'version (latest channel)',
                path: '/chocolatey/version/git/latest',
                data: $this->render([]),
            ),
        ];
    }

    private function pre(array $versions): array
    {
        return \array_filter($versions, fn ($v) => \str_contains($v, '-'));
    }

    private function stable(array $versions): array
    {
        return \array_filter($versions, fn ($v) => !\str_contains($v, '-'));
    }

    private function latest(array $versions): string|null
    {
        return \count($versions) > 0 ? \end($versions) : null;
    }
}
