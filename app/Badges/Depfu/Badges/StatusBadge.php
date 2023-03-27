<?php

declare(strict_types=1);

namespace App\Badges\Depfu\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class StatusBadge extends AbstractBadge
{
    protected string $route = '/depfu/status/{vcs:github,gitlab}/{project:wildcard}';

    protected array $keywords = [
        Category::ANALYSIS, Category::DEPENDENCIES,
    ];

    public function handle(string $vcs, string $project): array
    {
        return [
            'status' => $this->client->get($vcs, $project),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderStatus($this->service(), $properties['status']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'dependencies',
                path: '/depfu/status/github/depfu/example-ruby',
                data: $this->render(['status' => 'success']),
            ),
        ];
    }
}
