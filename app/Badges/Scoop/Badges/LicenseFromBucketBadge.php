<?php

declare(strict_types=1);

namespace App\Badges\Scoop\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class LicenseFromBucketBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/scoop/license/{bucket}/{app}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::LICENSE,
    ];

    public function handle(string $bucket, string $app): array
    {
        $response = $bucket === 'main' ? $this->client->main($app) : $this->client->extra($app);

        return [
            'bucket' => $bucket,
            'license' => $response['license'],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => $properties['bucket'] === 'main' ? 'scoop' : 'scoop-extras',
            'message' => $properties['license'],
            'messageColor' => 'blue.600',
        ];
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
            '/scoop/license/extras/deluge' => 'license',
        ];
    }
}
