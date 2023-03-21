<?php

declare(strict_types=1);

namespace App\Badges\OpenVSX\Badges;

use App\Badges\AbstractBadge;
use App\Badges\OpenVSX\Client;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class LicenseBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $extension): array
    {
        return $this->renderLicense($this->client->get($extension)['license']);
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
        return [];
    }

    public function routePaths(): array
    {
        return [
            '/open-vsx/license/{extension}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('extension', RoutePattern::CATCH_ALL->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/open-vsx/license/idleberg/electron-builder' => 'license',
        ];
    }
}
