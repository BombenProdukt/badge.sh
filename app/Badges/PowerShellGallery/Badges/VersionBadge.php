<?php

declare(strict_types=1);

namespace App\Badges\PowerShellGallery\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected string $route = '/powershellgallery/version/{project}/{channel?}';

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $project, ?string $channel = 'latest'): array
    {
        return [
            'version' => $this->client->get($project, $channel !== 'latest')->filterXPath('//m:properties/d:Version')->text(),
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
                path: '/powershellgallery/version/Azure.Storage',
                data: $this->render(['version' => '1.0.0']),
            ),
            new BadgePreviewData(
                name: 'version (pre channel)',
                path: '/powershellgallery/version/Azure.Storage/pre',
                data: $this->render(['version' => '1.0.0']),
            ),
            new BadgePreviewData(
                name: 'version (latest channel)',
                path: '/powershellgallery/version/Azure.Storage/latest',
                data: $this->render(['version' => '1.0.0']),
            ),
        ];
    }
}
