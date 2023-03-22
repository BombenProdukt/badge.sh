<?php

declare(strict_types=1);

namespace App\Badges\Conda\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Conda\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class DownloadsBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $channel, string $package): array
    {
        return $this->renderDownloads(collect($this->client->get($channel, $package)['files'])->sum('ndownloads'));
    }

    public function service(): string
    {
        return 'Conda';
    }

    public function keywords(): array
    {
        return [Category::DOWNLOADS];
    }

    public function routePaths(): array
    {
        return [
            '/conda/downloads/{channel}/{package}',
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
            '/conda/downloads/conda-forge/python' => '',
        ];
    }
}
