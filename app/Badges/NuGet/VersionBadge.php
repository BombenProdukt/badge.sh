<?php

declare(strict_types=1);

namespace App\Badges\NuGet;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected string $route = '/nuget/version/{project}/{channel?}';

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $project, ?string $channel = null): array
    {
        $versions = $this->client->get($project)['versions'];

        if ($channel === 'latest') {
            return [
                'version' => $this->latest($versions),
            ];
        }

        if ($channel === 'pre') {
            return [
                'version' => $this->latest($this->pre($versions)),
            ];
        }

        return [
            'version' => $this->latest($this->stable($versions)),
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
                path: '/nuget/version/Newtonsoft.Json',
                data: $this->render(['version' => '1.0.0']),
            ),
            new BadgePreviewData(
                name: 'version (pre channel)',
                path: '/nuget/version/Newtonsoft.Json/pre',
                data: $this->render(['version' => '1.0.0']),
            ),
            new BadgePreviewData(
                name: 'version (latest channel)',
                path: '/nuget/version/Newtonsoft.Json/latest',
                data: $this->render(['version' => '1.0.0']),
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
