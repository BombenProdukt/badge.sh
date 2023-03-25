<?php

declare(strict_types=1);

namespace App\Badges\AppVeyor\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class StatusBadge extends AbstractBadge
{
    public function handle(string $account, string $project, ?string $branch = null): array
    {
        return $this->client->get($account, $project, $branch ? "/branch/{$branch}" : '')['build'];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'appveyor',
            'message' => $properties['status'],
            'messageColor' => $properties['status'] === 'success' ? 'green.600' : 'red.600',
        ];
    }

    public function keywords(): array
    {
        return [Category::BUILD];
    }

    public function routePaths(): array
    {
        return [
            '/appveyor/status/{account}/{project}/{branch?}',
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
            '/appveyor/status/gruntjs/grunt' => 'build',
            '/appveyor/status/gruntjs/grunt/deprecate' => 'build (branch)',
        ];
    }
}
