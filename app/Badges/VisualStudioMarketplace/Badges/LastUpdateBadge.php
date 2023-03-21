<?php

declare(strict_types=1);

namespace App\Badges\VisualStudioMarketplace\Badges;

use App\Badges\Templates\DateTemplate;
use App\Badges\VisualStudioMarketplace\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class LastUpdateBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $extension): array
    {
        return DateTemplate::make('last updated', $this->client->get($extension)['lastUpdated']);
    }

    public function service(): string
    {
        return 'Visual Studio Marketplace';
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
            '/vs-marketplace/last-modified/{extension}',
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
            '/vs-marketplace/last-modified/vscodevim.vim' => 'last updated',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
