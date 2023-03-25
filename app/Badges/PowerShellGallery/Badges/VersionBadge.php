<?php

declare(strict_types=1);

namespace App\Badges\PowerShellGallery\Badges;

use App\Enums\Category;

final class VersionBadge extends AbstractBadge
{
    protected array $routes = [
        '/powershellgallery/version/{project}/{channel?}',
    ];

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
            '/powershellgallery/version/Azure.Storage' => 'version (stable channel)',
            '/powershellgallery/version/Azure.Storage/pre' => 'version (pre channel)',
            '/powershellgallery/version/Azure.Storage/latest' => 'version (latest channel)',
        ];
    }
}
