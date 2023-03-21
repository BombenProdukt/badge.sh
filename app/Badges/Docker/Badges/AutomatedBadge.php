<?php

declare(strict_types=1);

namespace App\Badges\Docker\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Docker\Client;
use App\Badges\Templates\TextTemplate;
use Illuminate\Routing\Route;

final class AutomatedBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $scope, string $name): array
    {
        $isAutomated = $this->client->info($scope, $name)['is_automated'];

        if ($isAutomated) {
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
        return [];
    }

    public function routePaths(): array
    {
        return [
            '/docker/build-automated/{scope}/{name}',
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
            '/docker/build-automated/jrottenberg/ffmpeg' => 'automated',
        ];
    }
}
