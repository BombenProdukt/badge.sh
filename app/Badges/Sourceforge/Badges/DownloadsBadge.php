<?php

declare(strict_types=1);

namespace App\Badges\Sourceforge\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Sourceforge\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class DownloadsBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $project, string $folder): array
    {
        return $this->renderDownloads($this->client->stats($project, $folder, 0)['total']);
    }

    public function service(): string
    {
        return 'SourceForge';
    }

    public function keywords(): array
    {
        return [Category::DOWNLOADS];
    }

    public function routePaths(): array
    {
        return [
            '/sourceforge/downloads/{project}/{folder}',
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
            '/sourceforge/downloads/arianne/stendhal' => 'total downloads',
        ];
    }
}
