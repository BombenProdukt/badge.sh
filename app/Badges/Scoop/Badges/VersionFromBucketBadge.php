<?php

declare(strict_types=1);

namespace App\Badges\Scoop\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class VersionFromBucketBadge extends AbstractBadge
{
    public function handle(string $bucket, string $app): array
    {
        $response = $bucket === 'main' ? $this->client->main($app) : $this->client->extra($app);

        return $this->renderVersion($response['version']);
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/scoop/version/{bucket}/{app}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->whereIn('bucket', ['extras', 'versions']);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/scoop/version/extras/age'        => 'version',
            '/scoop/version/extras/codeblocks' => 'version',
        ];
    }
}
