<?php

declare(strict_types=1);

namespace App\Badges\Spiget\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Spiget\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class DownloadsBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $resourceId): array
    {
        return $this->renderDownloads($this->client->latestVersion($resourceId)['downloads']);
    }

    public function service(): string
    {
        return 'Spiget';
    }

    public function keywords(): array
    {
        return [Category::DOWNLOADS];
    }

    public function routePaths(): array
    {
        return [
            '/spiget/downloads/{resourceId}',
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
            '/spiget/downloads/9089' => 'downloads',
        ];
    }
}
