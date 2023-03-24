<?php

declare(strict_types=1);

namespace App\Badges\CPAN\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class LicenseBadge extends AbstractBadge
{
    public function handle(string $distribution): array
    {
        return $this->renderLicense($this->client->get("release/{$distribution}")['license']);
    }

    public function keywords(): array
    {
        return [Category::LICENSE];
    }

    public function routePaths(): array
    {
        return [
            '/cpan/license/{distribution}',
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
            '/cpan/license/Perl::Tidy' => 'license',
        ];
    }
}
