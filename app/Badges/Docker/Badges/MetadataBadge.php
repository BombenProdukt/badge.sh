<?php

declare(strict_types=1);

namespace App\Badges\Docker\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class MetadataBadge extends AbstractBadge
{
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

    public function keywords(): array
    {
        return [Category::BUILD];
    }

    public function routePaths(): array
    {
        return [
            '/docker/metadata/{scope}/{name}/{type}/{tag?}/{architecture?}/{variant?}',
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
            '/docker/metadata/lucashalbert/curl/version/latest/arm64/v8'      => 'metadata (version)',
            '/docker/metadata/lucashalbert/curl/architecture/latest/arm64/v8' => 'metadata (architecture)',
            '/docker/metadata/lucashalbert/curl/build-date/latest/arm64/v8'   => 'metadata (build-date)',
            '/docker/metadata/lucashalbert/curl/maintainer/latest/arm64/v8'   => 'metadata (maintainer)',
        ];
    }
}
