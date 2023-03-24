<?php

declare(strict_types=1);

namespace App\Badges\VisualStudioMarketplace\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class InstallationsBadge extends AbstractBadge
{
    public function handle(string $extension): array
    {
        return [
            'count' => collect($this->client->get($extension)['statistics'])->firstWhere('statisticName', 'install')['value'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('installations', $properties['count']);
    }

    public function keywords(): array
    {
        return [Category::DOWNLOADS];
    }

    public function routePaths(): array
    {
        return [
            '/vs-marketplace/installations/{extension}',
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
            '/vs-marketplace/installations/vscodevim.vim' => 'installation count',
        ];
    }
}
