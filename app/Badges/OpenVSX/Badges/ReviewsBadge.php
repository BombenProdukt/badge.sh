<?php

declare(strict_types=1);

namespace App\Badges\OpenVSX\Badges;

use App\Badges\OpenVSX\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class ReviewsBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $namespace, string $package): array
    {
        $response = $this->client->get($namespace, $package);

        return [
            'label'       => 'reviews',
            'status'      => (string) $response['reviewCount'],
            'statusColor' => 'green.600',
        ];
    }

    public function service(): string
    {
        return 'Open VSX';
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
            '/open-vsx/reviews/{namespace}/{package}',
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
            '/open-vsx/reviews/idleberg/electron-builder' => 'reviews',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
