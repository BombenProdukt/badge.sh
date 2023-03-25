<?php

declare(strict_types=1);

namespace App\Badges\MozillaObservatory\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class ScoreBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/mozilla-observatory/score/{host}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $host): array
    {
        return $this->client->get($host);
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('observatory', $properties['score']);
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
            '/mozilla-observatory/score/github.com' => 'score',
        ];
    }
}
