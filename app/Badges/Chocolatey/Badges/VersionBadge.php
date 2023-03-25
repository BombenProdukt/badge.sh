<?php

declare(strict_types=1);

namespace App\Badges\Chocolatey\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class VersionBadge extends AbstractBadge
{
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

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/chocolatey/version/{project}/{channel?}',
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
            '/chocolatey/version/git' => 'version (stable channel)',
            '/chocolatey/version/git/pre' => 'version (pre channel)',
            '/chocolatey/version/git/latest' => 'version (latest channel)',
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
