<?php

declare(strict_types=1);

namespace App\Badges\MyGet\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class VersionBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/myget/version/{feed}/{project}/{channel?}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $feed, string $project, ?string $channel = 'latest'): array
    {
        $versions = collect($this->client->get($feed, $project)['versions'])->pluck('version')->toArray();

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
            '/myget/version/mongodb/MongoDB.Driver.Core' => 'version (stable channel)',
            '/myget/version/mongodb/MongoDB.Driver.Core/pre' => 'version (pre channel)',
            '/myget/version/mongodb/MongoDB.Driver.Core/latest' => 'version (latest channel)',
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
