<?php

declare(strict_types=1);

namespace App\Badges\MELPA\Badges;

use App\Actions\ExtractVersion;
use App\Actions\ExtractVersionColor;
use App\Badges\MELPA\Client;
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
        preg_match('/<title>([^<]+)<\//i', $this->client->get($package), $matches);

        [, $version] = explode(':', trim($matches[1]));

        return [
            'label'        => 'melpa',
            'status'       => ExtractVersion::execute($version),
            'statusColor'  => ExtractVersionColor::execute($version),
        ];
    }

    public function service(): string
    {
        return 'MELPA';
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
            '/melpa/v/{package}',
            '/melpa/version/{package}',
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
            '/melpa/v/magit' => 'version',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
