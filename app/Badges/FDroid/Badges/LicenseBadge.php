<?php

declare(strict_types=1);

namespace App\Badges\FDroid\Badges;

use App\Badges\FDroid\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class LicenseBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $appId): array
    {
        return [
            'label'       => 'license',
            'status'      => $this->client->get($appId)['License'] ?? 'unknown',
            'statusColor' => 'blue.600',
        ];
    }

    public function service(): string
    {
        return 'F-Droid';
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
            '/f-droid/license/{appId}',
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
            '/f-droid/license/org.tasks' => 'license',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
