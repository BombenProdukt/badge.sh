<?php

declare(strict_types=1);

namespace App\Badges\PowerShellGallery\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class VersionBadge extends AbstractBadge
{
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

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/powershellgallery/version/{project}/{channel?}',
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
            '/powershellgallery/version/Azure.Storage' => 'version (stable channel)',
            '/powershellgallery/version/Azure.Storage/pre' => 'version (pre channel)',
            '/powershellgallery/version/Azure.Storage/latest' => 'version (latest channel)',
        ];
    }
}
