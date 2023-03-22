<?php

declare(strict_types=1);

namespace App\Badges\MyGet\Badges;

use App\Badges\AbstractBadge;
use App\Badges\MyGet\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class VersionBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $feed, string $project, ?string $channel = 'latest'): array
    {
        $versions = collect($this->client->get($feed, $project)['versions'])->pluck('version')->toArray();

        if ($channel === 'latest') {
            $version = $this->latest($versions);
        }

        if ($channel === 'pre') {
            $version = $this->latest($this->pre($versions));
        }

        if (empty($channel)) {
            $version = $this->latest($this->stable($versions));
        }

        return $this->renderVersion($version);
    }

    public function service(): string
    {
        return 'MyGet';
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/myget/version/{feed}/{project}/{channel?}',
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
            '/myget/version/mongodb/MongoDB.Driver.Core'        => 'version (stable channel)',
            '/myget/version/mongodb/MongoDB.Driver.Core/pre'    => 'version (pre channel)',
            '/myget/version/mongodb/MongoDB.Driver.Core/latest' => 'version (latest channel)',
        ];
    }

    private function pre(array $versions): array
    {
        return array_filter($versions, fn ($v) => strpos($v, '-') !== false);
    }

    private function stable(array $versions): array
    {
        return array_filter($versions, fn ($v) => strpos($v, '-') === false);
    }

    private function latest(array $versions): string|null
    {
        return count($versions) > 0 ? end($versions) : null;
    }
}
