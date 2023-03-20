<?php

declare(strict_types=1);

namespace App\Badges\Docker\Badges;

use App\Badges\Docker\Client;
use App\Badges\Templates\TextTemplate;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class CloudBuildStatusBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $scope, string $name): array
    {
        $response = $this->client->build($scope, $name);

        if ($response['state'] === 'Success') {
            return TextTemplate::make('docker build', 'passing', 'green.600');
        }

        if ($response['state'] === 'Failed') {
            return TextTemplate::make('docker build', 'failing', 'red.600');
        }

        return TextTemplate::make('docker build', 'building', 'blue.600');
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
            '/docker/{scope}/{name}/cloud/build',
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
            '/docker/jrottenberg/ffmpeg/cloud/build' => 'build',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
