<?php

declare(strict_types=1);

namespace App\Badges\MozillaAddOns\Badges;

use App\Actions\ExtractVersion;
use App\Actions\ExtractVersionColor;
use App\Badges\MozillaAddOns\Client;
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
        $response = $this->client->get($package);

        return [
            'label'        => 'mozilla add-on',
            'status'       => ExtractVersion::execute($response['current_version']['version']),
            'statusColor'  => ExtractVersionColor::execute($response['current_version']['version']),
        ];
    }

    public function service(): string
    {
        return 'Mozilla Add-ons';
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
            '/amo/v/{package}',
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
            '/amo/v/markdown-viewer-chrome' => 'version',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
