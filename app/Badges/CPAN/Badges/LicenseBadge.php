<?php

declare(strict_types=1);

namespace App\Badges\CPAN\Badges;

use App\Badges\CPAN\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class LicenseBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $distribution): array
    {
        return [
            'label'       => 'license',
            'status'      => implode(' or ', $this->client->get("release/{$distribution}")['license']),
            'statusColor' => 'green.600',
        ];
    }

    public function service(): string
    {
        return 'CPAN';
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
            '/cpan/license/{distribution}',
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
            '/cpan/license/Perl::Tidy' => 'license',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
