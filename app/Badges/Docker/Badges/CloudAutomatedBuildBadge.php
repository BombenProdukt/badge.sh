<?php

declare(strict_types=1);

namespace App\Badges\Docker\Badges;

use App\Enums\Category;

final class CloudAutomatedBuildBadge extends AbstractBadge
{
    protected array $routes = [
        '/docker/cloud-automated/{scope}/{name}',
    ];

    protected array $keywords = [
        Category::BUILD,
    ];

    public function handle(string $scope, string $name): array
    {
        return [
            'settingsCount' => \count($this->client->build($scope, $name)['build_settings']),
        ];
    }

    public function render(array $properties): array
    {
        if ($properties['settingsCount'] >= 1) {
            return $this->renderText('docker build', 'automated', 'green.600');
        }

        return $this->renderText('docker build', 'manual', 'yellow.600');
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/docker/cloud-automated/jrottenberg/ffmpeg' => 'automated',
        ];
    }
}
