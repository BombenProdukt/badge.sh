<?php

declare(strict_types=1);

namespace App\Badges\Packagist\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class DependentsBadge extends AbstractBadge
{
    public function handle(string $package, ?string $channel = null): array
    {
        $packageMeta = $this->client->get($package);

        return [
            'label'        => 'dependents',
            'message'      => FormatNumber::execute($packageMeta['dependents']),
            'messageColor' => 'green.600',
        ];
    }

    public function keywords(): array
    {
        return [Category::SOCIAL];
    }

    public function routePaths(): array
    {
        return [
            '/packagist/dependents/{package}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('package', RoutePattern::PACKAGE_WITH_VENDOR_ONLY->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/packagist/dependents/monolog/monolog' => 'dependents',
        ];
    }
}
