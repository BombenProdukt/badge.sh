<?php

declare(strict_types=1);

namespace App\Badges\Chocolatey;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected string $route = '/chocolatey/version/{project}/{channel?}';

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $project, ?string $channel = 'latest'): array
    {
        return [
            'version' => $this->client->get($project, $channel !== 'latest')['Version'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'version (stable channel)',
                path: '/chocolatey/version/git',
                data: $this->render(['version' => '1.0.0']),
            ),
            new BadgePreviewData(
                name: 'version (pre channel)',
                path: '/chocolatey/version/git/pre',
                data: $this->render(['version' => '1.0.0']),
            ),
            new BadgePreviewData(
                name: 'version (latest channel)',
                path: '/chocolatey/version/git/latest',
                data: $this->render(['version' => '1.0.0']),
            ),
        ];
    }
}
