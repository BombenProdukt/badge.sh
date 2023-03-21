<?php

declare(strict_types=1);

namespace App\Badges\Jira\Badges;

use App\Badges\Jira\Client;
use App\Badges\Templates\LicenseTemplate;
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
        return LicenseTemplate::make($this->client->get($appId)['License']);
    }

    public function service(): string
    {
        return 'WIP';
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
            '/service/{package}',
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
            '/service/{package}' => '',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
