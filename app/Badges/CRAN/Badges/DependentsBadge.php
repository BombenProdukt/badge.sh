<?php

declare(strict_types=1);

namespace App\Badges\CRAN\Badges;

use App\Badges\AbstractBadge;
use App\Badges\CRAN\Client;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class DependentsBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $package): array
    {
        $response = $this->client->db("/-/revdeps/{$package}");

        return [
            'label'        => 'dependents',
            'message'      => FormatNumber::execute(count($response[$package]['Depends'])),
            'messageColor' => 'green.600',
        ];
    }

    public function service(): string
    {
        return 'CRAN';
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
            '/cran/dependents/{package}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        //
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/cran/dependents/R6' => 'dependents',
        ];
    }
}
