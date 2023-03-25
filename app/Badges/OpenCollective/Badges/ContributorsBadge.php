<?php

declare(strict_types=1);

namespace App\Badges\OpenCollective\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class ContributorsBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/opencollective/contributors/{slug}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::FUNDING,
    ];

    public function handle(string $slug): array
    {
        return [
            'count' => $this->client->get($slug)['contributorsCount'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('contributors', $properties['count']);
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
            '/opencollective/contributors/webpack' => 'contributors',
        ];
    }
}
