<?php

declare(strict_types=1);

namespace App\Badges\Packagist\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Packagist\Client;
use App\Badges\Packagist\Concerns\HandlesVersions;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;
use Illuminate\Support\Arr;

final class PhpVersionBadge extends AbstractBadge
{
    use HandlesVersions;

    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $package, ?string $channel = null): array
    {
        $packageMeta = $this->client->get($package);

        $pkg = Arr::get($packageMeta['versions'], $this->getVersion($packageMeta, $channel));

        return $this->renderVersion('php', Arr::get($pkg, 'require.php', '*'));
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
        return [];
    }

    public function routePaths(): array
    {
        return [
            '/packagist/php-version/{package}/{channel?}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('package', RoutePattern::PACKAGE_WITH_VENDOR_ONLY->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/packagist/php-version/monolog/monolog' => 'php',
        ];
    }
}
