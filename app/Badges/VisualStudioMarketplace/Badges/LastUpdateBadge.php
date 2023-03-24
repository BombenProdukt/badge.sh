<?php

declare(strict_types=1);

namespace App\Badges\VisualStudioMarketplace\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class LastUpdateBadge extends AbstractBadge
{
    public function handle(string $extension): array
    {
        return $this->renderDate('last updated', $this->client->get($extension)['lastUpdated']);
    }

    public function keywords(): array
    {
        return [Category::ACTIVITY];
    }

    public function routePaths(): array
    {
        return [
            '/vs-marketplace/last-modified/{extension}',
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
            '/vs-marketplace/last-modified/vscodevim.vim' => 'last updated',
        ];
    }
}
