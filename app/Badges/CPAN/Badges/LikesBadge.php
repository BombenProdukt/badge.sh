<?php

declare(strict_types=1);

namespace App\Badges\CPAN\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class LikesBadge extends AbstractBadge
{
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

    public function keywords(): array
    {
        return [Category::SOCIAL];
    }

    public function routePaths(): array
    {
        return [
            '/cpan/likes/{distribution}',
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
            '/cpan/likes/DBIx::Class' => 'likes',
        ];
    }
}
