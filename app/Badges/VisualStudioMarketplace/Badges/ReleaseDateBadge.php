<?php

declare(strict_types=1);

namespace App\Badges\VisualStudioMarketplace\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Templates\DateTemplate;
use App\Badges\VisualStudioMarketplace\Client;
use Illuminate\Routing\Route;

final class ReleaseDateBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $extension): array
    {
        return DateTemplate::make('release date', $this->client->get($extension)['releaseDate']);
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
        return [];
    }

    public function routePaths(): array
    {
        return [
            '/vs-marketplace/release-date/{extension}',
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
            '/vs-marketplace/release-date/vscodevim.vim' => 'release date',
        ];
    }
}
