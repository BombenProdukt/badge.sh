<?php

declare(strict_types=1);

namespace App\Badges\NodePing\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class StatusBadge extends AbstractBadge
{
    public function handle(string $uuid): array
    {
        $isOnline = $this->client->status($uuid);

        return $this->renderText('status', $isOnline ? 'online' : 'offline', $isOnline ? 'green.600' : 'red.600');
    }

    public function keywords(): array
    {
        return [Category::MONITORING];
    }

    public function routePaths(): array
    {
        return [
            '/nodeping/status/{uuid}',
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
            '/nodeping/status/jkiwn052-ntpp-4lbb-8d45-ihew6d9ucoei' => 'status',
        ];
    }
}
