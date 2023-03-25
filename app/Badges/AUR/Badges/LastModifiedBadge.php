<?php

declare(strict_types=1);

namespace App\Badges\AUR\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class LastModifiedBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/aur/last-modified/{package}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::ACTIVITY,
    ];

    public function handle(string $package): array
    {
        return [
            'date' => $this->client->get($package)['LastModified'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderDate('last modified', $properties['date']);
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
            '/aur/last-modified/google-chrome' => 'last modified',
        ];
    }
}
