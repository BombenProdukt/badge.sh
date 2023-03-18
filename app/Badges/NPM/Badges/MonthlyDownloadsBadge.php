<?php

declare(strict_types=1);

namespace App\Badges\NPM\Badges;

use App\Actions\FormatNumber;
use App\Badges\NPM\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class MonthlyDownloadsBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $package, string $tag = 'latest'): array
    {
        $downloads = $this->client->api("downloads/point/last-month/{$package}")['downloads'];

        return [
            'label'       => 'downloads',
            'status'      => FormatNumber::execute($downloads).'/month',
            'statusColor' => 'green.600',
        ];
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
        return [
            //
        ];
    }

    public function routePaths(): array
    {
        return [
            '/npm/dm/{package}/{tag?}',
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
            '/npm/dm/express' => 'monthly downloads',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
