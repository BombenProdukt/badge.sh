<?php

declare(strict_types=1);

namespace App\Badges\Modrinth\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Modrinth\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class DownloadsBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $projectId): array
    {
        return $this->renderDownloads($this->client->project($projectId)['downloads']);
    }

    public function service(): string
    {
        return 'Modrinth';
    }

    public function keywords(): array
    {
        return [Category::DOWNLOADS];
    }

    public function routePaths(): array
    {
        return [
            '/modrinth/downloads/{projectId}',
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
            '/modrinth/downloads/AANobbMI' => 'total downloads',
        ];
    }
}
