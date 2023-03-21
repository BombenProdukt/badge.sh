<?php

declare(strict_types=1);

namespace App\Badges\Crates\Badges;

use App\Badges\Crates\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class LatestVersionDownloadsBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $package): array
    {
        return [
            'label'        => 'downloads',
            'message'      => FormatNumber::execute($this->client->get($package)['recent_downloads']).' latest version',
            'messageColor' => 'green.600',
        ];
    }

    public function service(): string
    {
        return 'Crates';
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
            '/crates/downloads-recently/{package}',
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
            '/crates/downloads-recently/regex' => 'downloads (latest version)',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
