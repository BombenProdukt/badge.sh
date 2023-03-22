<?php

declare(strict_types=1);

namespace App\Badges\EclipseMarketplace\Badges;

use App\Badges\AbstractBadge;
use App\Badges\EclipseMarketplace\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class MonthlyDownloadsBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $name): array
    {
        return $this->renderDownloads($this->client->get($name)->filterXPath('//installsrecent')->text());
    }

    public function service(): string
    {
        return 'Eclipse Marketplace';
    }

    public function keywords(): array
    {
        return [Category::DOWNLOADS];
    }

    public function routePaths(): array
    {
        return [
            '/eclipse-marketplace/downloads-monthly/{name}',
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
            '/eclipse-marketplace/downloads-monthly/notepad4e' => 'monthly downloads',
        ];
    }
}
