<?php

declare(strict_types=1);

namespace App\Badges\OpenVSX\Badges;

use App\Actions\ExtractVersion;
use App\Actions\ExtractVersionColor;
use App\Badges\OpenVSX\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class VersionBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $namespace, string $package): array
    {
        $response = $this->client->get($namespace, $package);

        return [
            'label'        => 'version',
            'status'       => ExtractVersion::execute($response['version']),
            'statusColor'  => ExtractVersionColor::execute($response['version']),
        ];
    }

    public function service(): string
    {
        return 'Open VSX';
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
            '/open-vsx/v/{namespace}/{package}',
            '/open-vsx/version/{namespace}/{package}',
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
        //
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
            '/open-vsx/version/idleberg/electron-builder' => 'version',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
