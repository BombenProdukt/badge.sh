<?php

declare(strict_types=1);

namespace App\Badges\GalaxyToolShed\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class DownloadsBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/galaxy-tool-shed/downloads/{user}/{repo}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $user, string $repo): array
    {
        return [
            'downloads' => $this->client->fetchLastOrderedInstallableRevisionsSchema($user, $repo)['times_downloaded'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderDownloads($properties['downloads']);
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
