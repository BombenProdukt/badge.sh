<?php

declare(strict_types=1);

namespace App\Badges\Ecologi\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class CarbonBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/ecologi/carbon/{username}',
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
            'count' => $this->client->carbon($username),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('carbon offset', $properties['count']);
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
            '/ecologi/carbon/ecologi' => 'license',
        ];
    }
}
