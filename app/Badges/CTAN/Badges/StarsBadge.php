<?php

declare(strict_types=1);

namespace App\Badges\CTAN\Badges;

use App\Badges\CTAN\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatStars;

final class StarsBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $package): array
    {
        preg_match('/<span>[^<]*?([\d.]+)\s/i', $this->client->web($package), $matches);

        return [
            'label'       => 'rating',
            'status'      => FormatStars::execute($matches[1]),
            'statusColor' => 'green.600',
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
            '/ctan/{package}/stars',
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
            '/ctan/pgf-pie/stars' => 'stars',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
