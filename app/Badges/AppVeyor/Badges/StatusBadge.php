<?php

declare(strict_types=1);

namespace App\Badges\AppVeyor\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class StatusBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/appveyor/status/{account}/{project}/{branch?}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::BUILD,
    ];

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
