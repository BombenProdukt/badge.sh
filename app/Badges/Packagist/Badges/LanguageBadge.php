<?php

declare(strict_types=1);

namespace App\Badges\Packagist\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class LanguageBadge extends AbstractBadge
{
    public function handle(string $package, ?string $channel = null): array
    {
        $packageMeta = $this->client->get($package);

        return [
            'label'        => 'language',
            'message'      => $packageMeta['language'],
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
            '/packagist/language/{package}',
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
            '/packagist/language/monolog/monolog' => 'language',
        ];
    }
}
