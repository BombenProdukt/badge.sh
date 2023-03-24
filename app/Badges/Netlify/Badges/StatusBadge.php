<?php

declare(strict_types=1);

namespace App\Badges\Netlify\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class StatusBadge extends AbstractBadge
{
    public function handle(string $projectId): array
    {
        $status = $this->client->status($projectId);

        if (str_contains($status, '#0F4A21')) {
            $status = 'passing';
        }

        if (str_contains($status, '#800A20')) {
            $status = 'failing';
        }

        if (str_contains($status, '#603408')) {
            $status = 'building';
        }

        return $this->renderStatus('build', $status);
    }

    public function keywords(): array
    {
        return [Category::BUILD];
    }

    public function routePaths(): array
    {
        return [
            '/netlify/status/{projectId}',
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
            '/netlify/status/e6d5a4e0-dee1-4261-833e-2f47f509c68f' => 'license',
        ];
    }
}
