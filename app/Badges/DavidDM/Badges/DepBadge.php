<?php

declare(strict_types=1);

namespace App\Badges\DavidDM\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class DepBadge extends AbstractBadge
{
    protected string $route = '/david/dep/{repo:wildcard}/{path:wildcard?}';

    protected array $keywords = [
        Category::DEPENDENCIES,
    ];

    protected array $deprecated = [
        '2023-03-18' => 'Deprecated due to the deprecation of required APIs.',
    ];

    public function handle(string $repo, string $path): array
    {
        return $this->client->get($repo, $path);
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'dependencies',
            'message' => $this->statusInfo[$properties['status']][0],
            'messageColor' => $this->statusInfo[$properties['status']][1],
        ];
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'dependencies',
                path: '/david/dep/zeit/pkg',
                data: $this->render(['status' => 'uptodate']),
                deprecated: true,
            ),
            new BadgePreviewData(
                name: 'dependencies (sub path)',
                path: '/david/dep/babel/babel/packages/babel-cli',
                data: $this->render(['status' => 'uptodate']),
                deprecated: true,
            ),
        ];
    }
}
