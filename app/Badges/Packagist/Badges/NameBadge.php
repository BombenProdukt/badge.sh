<?php

declare(strict_types=1);

namespace App\Badges\Packagist\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class NameBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/packagist/name/{package}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::OTHER,
    ];

    public function handle(string $package, ?string $channel = null): array
    {
        return $this->client->get($package);
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'packagist',
            'message' => $properties['name'],
            'messageColor' => 'green.600',
        ];
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
            '/packagist/name/monolog/monolog' => 'name',
        ];
    }
}
