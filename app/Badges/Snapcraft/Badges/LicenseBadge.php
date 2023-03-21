<?php

declare(strict_types=1);

namespace App\Badges\Snapcraft\Badges;

use App\Badges\Snapcraft\Client;
use App\Badges\Templates\LicenseTemplate;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class LicenseBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $snap): array
    {
        return LicenseTemplate::make($this->client->get($snap)['snap']['license']);
    }

    public function service(): string
    {
        return 'Snapcraft';
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
            '/snapcraft/license/{snap}',
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
            '/snapcraft/license/okular' => 'license',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
