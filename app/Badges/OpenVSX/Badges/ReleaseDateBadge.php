<?php

declare(strict_types=1);

namespace App\Badges\OpenVSX\Badges;

use App\Badges\AbstractBadge;
use App\Badges\OpenVSX\Client;
use App\Badges\Templates\DateTemplate;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class ReleaseDateBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $extension): array
    {
        return DateTemplate::make('release date', $this->client->get($extension)['timestamp']);
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
            '/open-vsx/release-date/{extension}',
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
            '/open-vsx/release-date/idleberg/electron-builder' => 'release date',
        ];
    }
}
