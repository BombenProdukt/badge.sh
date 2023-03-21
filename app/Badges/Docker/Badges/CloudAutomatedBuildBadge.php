<?php

declare(strict_types=1);

namespace App\Badges\Docker\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Docker\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class CloudAutomatedBuildBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $scope, string $name): array
    {
        $settings = $this->client->build($scope, $name)['build_settings'];

        if (count($settings) >= 1) {
            return $this->renderText('docker build', 'automated', 'green.600');
        }

        return $this->renderText('docker build', 'manual', 'yellow.600');
    }

    public function service(): string
    {
        return 'Docker';
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
