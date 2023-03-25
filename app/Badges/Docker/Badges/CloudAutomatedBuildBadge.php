<?php

declare(strict_types=1);

namespace App\Badges\Docker\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class CloudAutomatedBuildBadge extends AbstractBadge
{
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

    public function keywords(): array
    {
        return [Category::BUILD];
    }

    public function routePaths(): array
    {
        return [
            '/docker/cloud-automated/{scope}/{name}',
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
            '/docker/cloud-automated/jrottenberg/ffmpeg' => 'automated',
        ];
    }
}
