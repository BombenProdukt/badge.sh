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
            'label'        => $type,
            'message'      => $response['container_config']['Labels']["org.label-schema.{$type}"] ?? $response['container_config']['Labels']["org.opencontainers.image.{$type}"],
            'messageColor' => 'blue.600',
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
            '/docker/{scope}/{name}/metadata/{type}/{tag?}/{architecture?}/{variant?}',
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
            '/docker/lucashalbert/curl/metadata/version/latest/arm64/v8'      => 'metadata (version)',
            '/docker/lucashalbert/curl/metadata/architecture/latest/arm64/v8' => 'metadata (architecture)',
            '/docker/lucashalbert/curl/metadata/build-date/latest/arm64/v8'   => 'metadata (build-date)',
            '/docker/lucashalbert/curl/metadata/maintainer/latest/arm64/v8'   => 'metadata (maintainer)',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
