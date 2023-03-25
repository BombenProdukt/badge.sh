<?php

declare(strict_types=1);

namespace App\Badges\AppVeyor\Badges;

use App\Enums\Category;

final class StatusBadge extends AbstractBadge
{
    protected array $routes = [
        '/appveyor/status/{account}/{project}/{branch?}',
    ];

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
