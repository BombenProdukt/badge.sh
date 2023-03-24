<?php

declare(strict_types=1);

namespace App\Badges\Gerrit\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class StatusBadge extends AbstractBadge
{
    public function handle(string $changeId): array
    {
        return $this->client->get($changeId);
    }

    public function render(array $properties): array
    {
        return $this->renderStatus('status', $properties['status']);
    }

    public function keywords(): array
    {
        return [Category::LICENSE];
    }

    public function routePaths(): array
    {
        return [
            '/gerrit/status/{changeId}',
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
            '/gerrit/status/1011478' => 'status',
        ];
    }
}
