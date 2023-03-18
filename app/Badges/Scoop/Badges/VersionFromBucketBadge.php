<?php

declare(strict_types=1);

namespace App\Badges\Scoop\Badges;

use App\Actions\ExtractVersion;
use App\Actions\ExtractVersionColor;
use App\Badges\Scoop\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class VersionFromBucketBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $bucket, string $app): array
    {
        $response = $bucket === 'main' ? $this->client->main($app) : $this->client->extra($app);

        return [
            'label'        => 'scoop',
            'status'       => ExtractVersion::execute($response['version']),
            'statusColor'  => ExtractVersionColor::execute($response['version']),
        ];
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
        return [
            //
        ];
    }

    public function routePaths(): array
    {
        return [
            '/scoop/{bucket}/v/{app}',
        ];
    }

    public function routeParameters(): array
    {
        return [
            //
        ];
    }

    public function routeConstraints(Route $route): void
    {
        $route->whereIn('bucket', ['extras', 'versions']);
    }

    public function staticPreviews(): array
    {
        return [
            //
        ];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/scoop/extras/v/age'        => 'version',
            '/scoop/extras/v/codeblocks' => 'version',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
