<?php

declare(strict_types=1);

namespace App\Badges\VaadinAddOnDirectory\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class ReleaseDateBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/vaadin/release-date/{packageName}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::ACTIVITY,
    ];

    public function handle(string $packageName): array
    {
        return [
            'date' => $this->client->get($packageName)['latestAvailableRelease']['publicationDate'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderDate('release date', $properties['date']);
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
            '/vaadin/release-date/vaadinvaadin-grid' => 'release date',
        ];
    }
}
