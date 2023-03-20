<?php

declare(strict_types=1);

namespace App\Badges\Docker\Badges;

use App\Badges\Docker\Client;
use App\Badges\Templates\TextTemplate;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class CloudAutomatedBuildBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $scope, string $name): array
    {
        $settings = $this->client->build($scope, $name)['build_settings'];

        if (count($settings) >= 1) {
            return TextTemplate::make('docker build', 'automated', 'green.600');
        }

        return TextTemplate::make('docker build', 'manual', 'yellow.600');
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
            '/docker/{scope}/{name}/cloud/automated',
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
            '/docker/jrottenberg/ffmpeg/cloud/automated' => 'automated',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
