<?php

declare(strict_types=1);

namespace App\Badges\HexPM\Badges;

use App\Badges\AbstractBadge;
use App\Badges\HexPM\Client;
use Illuminate\Routing\Route;

final class VersionBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $packageName): array
    {
        $response = $this->client->get($packageName);

        return $this->renderVersion($response['latest_stable_version'] ?? $response['latest_version']);
    }

    public function service(): string
    {
        return 'hex.pm';
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
            '/hex/version/{packageName}',
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
            '/hex/version/plug' => 'version',
        ];
    }
}
