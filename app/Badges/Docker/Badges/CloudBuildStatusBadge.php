<?php

declare(strict_types=1);

namespace App\Badges\Docker\Badges;

use App\Enums\Category;

final class CloudBuildStatusBadge extends AbstractBadge
{
    protected array $routes = [
        '/docker/cloud-build/{scope}/{name}',
    ];

    protected array $keywords = [
        Category::BUILD,
    ];

    public function handle(string $scope, string $name): array
    {
        return $this->client->build($scope, $name);
    }

    public function render(array $properties): array
    {
        if ($properties['state'] === 'Success') {
            return $this->renderText('docker build', 'passing', 'green.600');
        }

        if ($properties['state'] === 'Failed') {
            return $this->renderText('docker build', 'failing', 'red.600');
        }

        return $this->renderText('docker build', 'building', 'blue.600');
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/docker/cloud-build/jrottenberg/ffmpeg' => 'build',
        ];
    }
}
