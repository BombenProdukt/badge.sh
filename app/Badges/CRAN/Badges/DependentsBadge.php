<?php

declare(strict_types=1);

namespace App\Badges\CRAN\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class DependentsBadge extends AbstractBadge
{
    public function handle(string $package): array
    {
        $response = $this->client->db("/-/revdeps/{$package}");

        return [
            'label'        => 'dependents',
            'message'      => FormatNumber::execute(count($response[$package]['Depends'])),
            'messageColor' => 'green.600',
        ];
    }

    public function keywords(): array
    {
        return [Category::ANALYSIS];
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
