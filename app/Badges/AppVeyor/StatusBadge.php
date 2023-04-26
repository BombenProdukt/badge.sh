<?php

declare(strict_types=1);

namespace App\Badges\AppVeyor;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class StatusBadge extends AbstractBadge
{
    protected string $route = '/appveyor/status/{account}/{project}/{branch?}';

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

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'build',
                path: '/appveyor/status/gruntjs/grunt',
                data: $this->render(['status' => 'success']),
            ),
            new BadgePreviewData(
                name: 'build (branch)',
                path: '/appveyor/status/gruntjs/grunt/deprecate',
                data: $this->render(['status' => 'success']),
            ),
        ];
    }
}
