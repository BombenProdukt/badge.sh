<?php

declare(strict_types=1);

namespace App\Badges\CPAN\Badges;

use App\Enums\Category;

final class LikesBadge extends AbstractBadge
{
    protected array $routes = [
        '/cpan/likes/{distribution}',
    ];

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

    public function previews(): array
    {
        return [
            '/cpan/likes/DBIx::Class' => 'likes',
        ];
    }
}
