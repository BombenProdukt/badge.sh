<?php

declare(strict_types=1);

namespace App\Badges\AtomPackage\Badges;

use App\Actions\FormatNumber;
use App\Badges\AtomPackage\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class TotalDownloadsBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $package): array
    {
        return [
            'label'       => 'downloads',
            'status'      => FormatNumber::execute($this->client->get($package)['downloads']),
            'statusColor' => 'green.600',
        ];
    }

    public function service(): string
    {
        return 'Atom Package';
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
            '/apm/dl/{package}',
            '/apm/downloads/{package}',
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
            '/apm/v/linter' => 'version',
        ];
    }

    public function deprecated(): array
    {
        return [
            '2023-03-18' => 'Deprecated due to the deprecation of required APIs.',
        ];
    }
}
