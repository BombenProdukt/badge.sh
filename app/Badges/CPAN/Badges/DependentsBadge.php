<?php

declare(strict_types=1);

namespace App\Badges\CPAN\Badges;

use App\Badges\CPAN\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class DependentsBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $distribution): array
    {
        return [
            'label'        => 'dependents',
            'message'      => FormatNumber::execute($this->client->get("reverse_dependencies/dist/{$distribution}")['total'] ?? 0),
            'messageColor' => 'green.600',
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
            '/cpan/dependents/{distribution}',
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
            '/cpan/dependents/DateTime' => 'dependents',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
