<?php

declare(strict_types=1);

namespace App\Badges\CPAN\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class LikesBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/cpan/likes/{distribution}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $distribution): array
    {
        return [
            'count' => $this->client->get('favorite/agg_by_distributions', ['distribution' => $distribution])['favorites'][$distribution],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('likes', $properties['count']);
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
            '/cpan/likes/DBIx::Class' => 'likes',
        ];
    }
}
