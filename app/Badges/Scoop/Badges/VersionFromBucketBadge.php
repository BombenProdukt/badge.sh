<?php

declare(strict_types=1);

namespace App\Badges\Scoop\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Scoop\Client;
use App\Badges\Templates\VersionTemplate;
use Illuminate\Routing\Route;

final class VersionFromBucketBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $bucket, string $app): array
    {
        $response = $bucket === 'main' ? $this->client->main($app) : $this->client->extra($app);

        return VersionTemplate::make($this->service(), $response['version']);
    }

    public function service(): string
    {
        return 'Scoop';
    }

    public function title(): string
    {
        return '';
    }

    public function keywords(): array
    {
        return [];
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
