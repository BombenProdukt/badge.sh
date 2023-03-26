<?php

declare(strict_types=1);

namespace App\Badges\CircleCI\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class StatusBadge extends AbstractBadge
{
    protected array $routes = [
        '/circleci/status/{vcs:github,gitlab}/{repo:packageWithVendorOnly}/{branch?}',
    ];

    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $vcs, string $repo, ?string $branch = null): array
    {
        return $this->client->get($vcs, $repo, $branch)[0];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'circleci',
            'message' => \str_replace('_', ' ', $properties['status']),
            'messageColor' => ['failed' => 'red.600', 'success' => 'green.600'][$properties['status']] ?? 'gray.600',
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'build',
                path: '/circleci/status/github/circleci/ex',
                data: $this->render(['status' => 'success']),
            ),
            new BadgePreviewData(
                name: 'build (branch)',
                path: '/circleci/status/github/circleci/ex/main',
                data: $this->render(['status' => 'success']),
            ),
        ];
    }
}
