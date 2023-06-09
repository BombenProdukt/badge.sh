<?php

declare(strict_types=1);

namespace App\Badges\Docker;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class MetadataBadge extends AbstractBadge
{
    protected string $route = '/docker/metadata/{scope}/{name}/{type}/{tag?}/{architecture?}/{variant?}';

    protected array $keywords = [
        Category::BUILD,
    ];

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
            'type' => $type,
            'metadata' => $response['container_config']['Labels']["org.label-schema.{$type}"] ?? $response['container_config']['Labels']["org.opencontainers.image.{$type}"],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => $properties['type'],
            'message' => $properties['metadata'],
            'messageColor' => 'blue.600',
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'metadata (version)',
                path: '/docker/metadata/lucashalbert/curl/version/latest/arm64/v8',
                data: $this->render(['type' => 'version', 'metadata' => '1.0.0']),
            ),
            new BadgePreviewData(
                name: 'metadata (architecture)',
                path: '/docker/metadata/lucashalbert/curl/architecture/latest/arm64/v8',
                data: $this->render(['type' => 'architecture', 'metadata' => 'arm64']),
            ),
            new BadgePreviewData(
                name: 'metadata (build-date)',
                path: '/docker/metadata/lucashalbert/curl/build-date/latest/arm64/v8',
                data: $this->render(['type' => 'build-date', 'metadata' => '2021-01-01T00:00:00Z']),
            ),
            new BadgePreviewData(
                name: 'metadata (maintainer)',
                path: '/docker/metadata/lucashalbert/curl/maintainer/latest/arm64/v8',
                data: $this->render(['type' => 'maintainer', 'metadata' => 'Lucas Halbert']),
            ),
        ];
    }
}
