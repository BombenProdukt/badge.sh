<?php

declare(strict_types=1);

namespace App\Badges\CTAN\Badges;

use App\Actions\ExtractVersion;
use App\Actions\ExtractVersionColor;
use App\Badges\CTAN\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class VersionBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $package): array
    {
        $version = $this->client->api($package)['version']['number'];

        return [
            'label'        => 'ctan',
            'status'       => ExtractVersion::execute($version),
            'statusColor'  => ExtractVersionColor::execute($version),
        ];
    }

    public function service(): string
    {
        return 'CTAN';
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
            '/ctan/v/{package}',
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
            '/ctan/v/latexindent' => 'version',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
