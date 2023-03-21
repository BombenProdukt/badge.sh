<?php

declare(strict_types=1);

namespace App\Badges\Bitbucket\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Bitbucket\Client;
use App\Badges\Templates\LicenseTemplate;
use Illuminate\Routing\Route;

final class LicenseBadge extends AbstractBadge
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
        return [];
    }

    public function routePaths(): array
    {
        return [
            '/service/{package}',
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
            '/service/{package}' => '',
        ];
    }
}
