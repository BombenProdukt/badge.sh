<?php

declare(strict_types=1);

namespace App\Badges\GalaxyToolShed\Badges;

use App\Badges\AbstractBadge;
use App\Badges\GalaxyToolShed\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class DownloadsBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $user, string $repo): array
    {
        return $this->renderDownloads($this->client->fetchLastOrderedInstallableRevisionsSchema($user, $repo)['times_downloaded']);
    }

    public function service(): string
    {
        return 'Galaxy Tool Shed';
    }

    public function keywords(): array
    {
        return [Category::DOWNLOADS];
    }

    public function routePaths(): array
    {
        return [
            '/galaxy-tool-shed/downloads/{user}/{repo}',
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
            '/galaxy-tool-shed/downloads/iuc/sra_tools' => 'downloads',
        ];
    }
}