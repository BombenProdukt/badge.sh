<?php

declare(strict_types=1);

namespace App\Badges\NuGet\Badges;

use App\Actions\ExtractVersion;
use App\Actions\ExtractVersionColor;
use App\Badges\NuGet\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class VersionBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $project, ?string $channel = null): array
    {
        $versions = $this->client->get($project)['versions'];

        if ($channel === 'latest') {
            $version = $this->latest($versions);
        }

        if ($channel === 'pre') {
            $version = $this->latest($this->pre($versions));
        }

        if (empty($channel)) {
            $version = $this->latest($this->stable($versions));
        }

        return [
            'label'       => 'nuget',
            'status'      => ExtractVersion::execute($version),
            'statusColor' => ExtractVersionColor::execute($version),
        ];
    }

    public function service(): string
    {
        return 'NuGet';
    }

    public function title(): string
    {
        return '';
    }

    public function keywords(): array
    {
        return [
            //
        ];
    }

    public function routePaths(): array
    {
        return [
            '/nuget/v/{project}/{channel?}',
        ];
    }

    public function routeParameters(): array
    {
        return [
            //
        ];
    }

    public function routeConstraints(Route $route): void
    {
        //
    }

    public function staticPreviews(): array
    {
        return [
            //
        ];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/nuget/v/Newtonsoft.Json'        => 'version (stable channel)',
            '/nuget/v/Newtonsoft.Json/pre'    => 'version (pre channel)',
            '/nuget/v/Newtonsoft.Json/latest' => 'version (latest channel)',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
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
