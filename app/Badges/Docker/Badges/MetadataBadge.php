<?php

declare(strict_types=1);

namespace App\Badges\Docker\Badges;

use App\Badges\Docker\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class MetadataBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(
        string $type,
        string $scope,
        string $name,
        string $tag = 'latest',
        string $architecture = 'amd64',
        string $variant = '',
    ): array {
        $response = $this->client->config($scope, $name, $tag, $architecture, $variant);

        return [
            'label'       => $type,
            'status'      => $response['container_config']['Labels']["org.label-schema.{$type}"] ?? $response['container_config']['Labels']["org.opencontainers.image.{$type}"],
            'statusColor' => 'blue.600',
        ];
    }

    public function service(): string
    {
        return 'Docker';
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
            '/docker/metadata/{type}/{scope}/{name}/{tag?}/{architecture?}/{variant?}',
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
            '/docker/metadata/version/lucashalbert/curl/latest/arm64/v8'      => 'metadata (version)',
            '/docker/metadata/architecture/lucashalbert/curl/latest/arm64/v8' => 'metadata (architecture)',
            '/docker/metadata/build-date/lucashalbert/curl/latest/arm64/v8'   => 'metadata (build-date)',
            '/docker/metadata/maintainer/lucashalbert/curl/latest/arm64/v8'   => 'metadata (maintainer)',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
