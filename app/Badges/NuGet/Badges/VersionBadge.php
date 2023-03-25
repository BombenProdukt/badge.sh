<?php

declare(strict_types=1);

namespace App\Badges\NuGet\Badges;

use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected array $routes = [
        '/nuget/version/{project}/{channel?}',
    ];

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

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/nuget/version/Newtonsoft.Json' => 'version (stable channel)',
            '/nuget/version/Newtonsoft.Json/pre' => 'version (pre channel)',
            '/nuget/version/Newtonsoft.Json/latest' => 'version (latest channel)',
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
