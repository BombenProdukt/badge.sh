<?php

declare(strict_types=1);

namespace App\Badges\Steam\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class FileReleaseDateBadge extends AbstractBadge
{
    public function handle(string $fileId): array
    {
        return $this->renderDateDiff('last modified', $this->client->file($fileId)['time_created']);
    }

    public function keywords(): array
    {
        return [Category::ACTIVITY];
    }

    public function routePaths(): array
    {
        return [
            '/steam/file-release-date/{fileId}',
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
            '/steam/file-release-date/100' => 'file last modified',
        ];
    }
}
