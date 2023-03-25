<?php

declare(strict_types=1);

namespace App\Badges\Scoop\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class VersionFromBucketBadge extends AbstractBadge
{
    protected array $routes = [
        '/scoop/version/{bucket}/{app}',
    ];

    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $bucket, string $app): array
    {
        return $bucket === 'main' ? $this->client->main($app) : $this->client->extra($app);
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version']);
    }

    public function routeConstraints(Route $route): void
    {
        $route->whereIn('bucket', ['extras', 'versions']);
    }

    public function previews(): array
    {
        return [
            '/scoop/version/extras/age' => 'version',
            '/scoop/version/extras/codeblocks' => 'version',
        ];
    }
}
