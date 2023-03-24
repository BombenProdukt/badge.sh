<?php

declare(strict_types=1);

namespace App\Badges\VisualStudioMarketplace\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class ReleaseDateBadge extends AbstractBadge
{
    public function handle(string $extension): array
    {
        return [
            'date' => $this->client->get($extension)['releaseDate'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderDate('release date', $properties['date']);
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/vs-marketplace/release-date/{extension}',
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
            '/vs-marketplace/release-date/vscodevim.vim' => 'release date',
        ];
    }
}
