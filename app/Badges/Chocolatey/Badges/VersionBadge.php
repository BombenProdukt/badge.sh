<?php

declare(strict_types=1);

namespace App\Badges\Chocolatey\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Chocolatey\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class VersionBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $project, ?string $channel = 'latest'): array
    {
        return $this->renderVersion($this->client->get($project, $channel !== 'latest')['Version']);
    }

    public function service(): string
    {
        return 'Chocolatey';
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
            '/chocolatey/version/git'        => 'version (stable channel)',
            '/chocolatey/version/git/pre'    => 'version (pre channel)',
            '/chocolatey/version/git/latest' => 'version (latest channel)',
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
