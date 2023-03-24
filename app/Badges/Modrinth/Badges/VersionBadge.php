<?php

declare(strict_types=1);

namespace App\Badges\Modrinth\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class VersionBadge extends AbstractBadge
{
    public function handle(string $projectId): array
    {
        return $this->renderVersion($this->client->version($projectId)['version_number']);
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/modrinth/version/{projectId}',
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
            '/modrinth/version/AANobbMI' => 'version',
        ];
    }
}
