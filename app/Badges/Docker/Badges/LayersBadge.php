<?php

declare(strict_types=1);

namespace App\Badges\Docker\Badges;

use App\Enums\Category;

final class LayersBadge extends AbstractBadge
{
    protected array $routes = [
        '/docker/layers/{scope}/{name}/{tag?}/{architecture?}/{variant?}',
    ];

    protected array $keywords = [
        Category::BUILD,
    ];

    public function handle(
        string $scope,
        string $name,
        string $tag = 'latest',
        string $architecture = 'amd64',
        string $variant = '',
    ): array {
        return [
            'count' => \count($this->client->config($scope, $name, $tag, $architecture, $variant)['history']),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('docker layers', $properties['count']);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/docker/layers/lucashalbert/curl/latest/arm/v7' => 'layers (size)',
            '/docker/layers/lucashalbert/curl/latest/arm/v7' => 'layers (icon & label)',
            '/docker/layers/lucashalbert/curl/latest/arm/v7' => 'layers (label)',
        ];
    }
}
