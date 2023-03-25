<?php

declare(strict_types=1);

namespace App\Badges\Scoop\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class LicenseFromBucketBadge extends AbstractBadge
{
    protected array $routes = [
        '/scoop/license/{bucket}/{app}',
    ];

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

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'license',
                path: '/scoop/license/extras/deluge',
                data: $this->render([]),
            ),
        ];
    }
}
