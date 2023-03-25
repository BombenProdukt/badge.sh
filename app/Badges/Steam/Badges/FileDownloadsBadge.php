<?php

declare(strict_types=1);

namespace App\Badges\Steam\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class FileDownloadsBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/steam/file-downloads/{fileId}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::DOWNLOADS,
    ];

    public function handle(string $fileId): array
    {
        return [
            'subscriptions' => $this->client->file($fileId)['lifetime_subscriptions'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderDownloads($properties['subscriptions']);
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
            '/steam/file-downloads/{fileId}' => 'file downloads',
        ];
    }
}
