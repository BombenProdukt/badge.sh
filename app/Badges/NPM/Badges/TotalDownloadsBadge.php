<?php

declare(strict_types=1);

namespace App\Badges\NPM\Badges;

use App\Badges\AbstractBadge;
use App\Badges\NPM\Client;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class TotalDownloadsBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $package, string $tag = 'latest'): array
    {
        $downloads = $this->client->api('downloads/range/2005-01-01:'.date('Y')."-01-01/{$package}")['downloads'];

        return $this->renderDownloads(collect($downloads)->sum('downloads'));
    }

    public function service(): string
    {
        return 'npm';
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
            '/npm/downloads/{package}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('package', RoutePattern::PACKAGE_WITH_SCOPE->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/npm/downloads/express' => 'total downloads',
        ];
    }
}
