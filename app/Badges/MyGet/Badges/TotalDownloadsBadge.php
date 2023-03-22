<?php

declare(strict_types=1);

namespace App\Badges\MyGet\Badges;

use App\Badges\AbstractBadge;
use App\Badges\MyGet\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class TotalDownloadsBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $feed, string $project): array
    {
        return $this->renderDownloads($this->client->get($feed, $project)['totaldownloads']);
    }

    public function service(): string
    {
        return 'MyGet';
    }

    public function keywords(): array
    {
        return [Category::DOWNLOADS];
    }

    public function routePaths(): array
    {
        return [
            '/myget/downloads/{feed}/{project}',
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
            '/myget/downloads/mongodb/MongoDB.Driver.Core' => 'total downloads',
        ];
    }
}
