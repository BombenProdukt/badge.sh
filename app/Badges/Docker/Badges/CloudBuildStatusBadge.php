<?php

declare(strict_types=1);

namespace App\Badges\Docker\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class CloudBuildStatusBadge extends AbstractBadge
{
    public function handle(string $scope, string $name): array
    {
        $response = $this->client->build($scope, $name);

        if ($response['state'] === 'Success') {
            return $this->renderText('docker build', 'passing', 'green.600');
        }

        if ($response['state'] === 'Failed') {
            return $this->renderText('docker build', 'failing', 'red.600');
        }

        return $this->renderText('docker build', 'building', 'blue.600');
    }

    public function keywords(): array
    {
        return [Category::BUILD];
    }

    public function routePaths(): array
    {
        return [
            '/docker/cloud-build/{scope}/{name}',
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
            '/docker/cloud-build/jrottenberg/ffmpeg' => 'build',
        ];
    }
}
