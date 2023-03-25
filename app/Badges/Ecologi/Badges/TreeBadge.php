<?php

declare(strict_types=1);

namespace App\Badges\Ecologi\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class TreeBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/ecologi/trees/{username}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::OTHER,
    ];

    public function handle(string $username): array
    {
        return [
            'count' => $this->client->trees($username),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('trees', $properties['count']);
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
            '/ecologi/trees/ecologi' => 'license',
        ];
    }
}
