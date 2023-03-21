<?php

declare(strict_types=1);

namespace App\Badges\Docker\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Docker\Client;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class LayersBadge extends AbstractBadge
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
            'label'        => 'docker layers',
            'message'      => FormatNumber::execute(count($response['history'])),
            'messageColor' => 'blue.600',
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
        return [];
    }

    public function routePaths(): array
    {
        return [
            '/docker/layers/{scope}/{name}/{tag?}/{architecture?}/{variant?}',
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
            '/docker/layers/lucashalbert/curl/latest/arm/v7' => 'layers (size)',
            '/docker/layers/lucashalbert/curl/latest/arm/v7' => 'layers (icon & label)',
            '/docker/layers/lucashalbert/curl/latest/arm/v7' => 'layers (label)',
        ];
    }
}
