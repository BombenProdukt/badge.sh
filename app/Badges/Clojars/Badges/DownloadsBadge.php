<?php

declare(strict_types=1);

namespace App\Badges\Clojars\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class DownloadsBadge extends AbstractBadge
{
    public function handle(string $clojar): array
    {
        return $this->client->get($clojar);
    }

    public function render(array $properties): array
    {
        return $this->renderDownloads($properties['downloads']);
    }

    public function keywords(): array
    {
        return [Category::DOWNLOADS];
    }

    public function routePaths(): array
    {
        return [
            '/clojars/downloads/{clojar}',
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
            '/clojars/downloads/prismic' => 'total downlodas',
        ];
    }
}
