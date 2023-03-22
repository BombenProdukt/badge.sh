<?php

declare(strict_types=1);

namespace App\Badges\PowerShellGallery\Badges;

use App\Badges\AbstractBadge;
use App\Badges\PowerShellGallery\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class VersionBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $project, ?string $channel = 'latest'): array
    {
        return $this->renderVersion($this->client->get($project, $channel !== 'latest')->filterXPath('//m:properties/d:Version')->text());
    }

    public function service(): string
    {
        return 'PowerShell Gallery';
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
            '/powershellgallery/version/Azure.Storage'        => 'version (stable channel)',
            '/powershellgallery/version/Azure.Storage/pre'    => 'version (pre channel)',
            '/powershellgallery/version/Azure.Storage/latest' => 'version (latest channel)',
        ];
    }
}
