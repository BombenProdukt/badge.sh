<?php

declare(strict_types=1);

namespace App\Badges\Docker\Badges;

use App\Badges\Docker\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class LayersBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(
        string $scope,
        string $name,
        string $tag = 'latest',
        string $architecture = 'amd64',
        string $variant = '',
    ): array {
        $response = $this->client->config($scope, $name, $tag, $architecture, $variant);

        return [
            'label'       => 'docker layers',
            'status'      => FormatNumber::execute(count($response['history'])),
            'statusColor' => 'blue.600',
        ];
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
            '/docker/{scope}/{name}/layers/{tag?}/{architecture?}/{variant?}',
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
            '/docker/lucashalbert/curl/layers/latest/arm/v7' => 'layers (size)',
            '/docker/lucashalbert/curl/layers/latest/arm/v7' => 'layers (icon & label)',
            '/docker/lucashalbert/curl/layers/latest/arm/v7' => 'layers (label)',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
