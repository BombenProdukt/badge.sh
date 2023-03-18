<?php

declare(strict_types=1);

namespace App\Badges\Packagist\Badges;

use App\Badges\Packagist\Client;
use App\Badges\Packagist\Concerns\HandlesVersions;
use App\Contracts\Badge;
use Illuminate\Routing\Route;
use Illuminate\Support\Arr;

final class PhpVersionBadge implements Badge
{
    use HandlesVersions;

    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $vendor, string $package, ?string $channel = null): array
    {
        $packageMeta = $this->client->get($vendor, $package);

        $pkg = Arr::get($packageMeta['versions'], $this->getVersion($packageMeta, $channel));

        return [
            'label'       => 'php',
            'status'      => Arr::get($pkg, 'require.php', '*'),
            'statusColor' => 'green.600',
        ];
    }

    public function service(): string
    {
        return 'Packagist';
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
            '/packagist/php/{vendor}/{package}/{channel?}',
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
            '/packagist/php/monolog/monolog' => 'php',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
