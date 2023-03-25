<?php

declare(strict_types=1);

namespace App\Badges\NPMS\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class FinalScoreBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/npms/final-score/{package}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $package): array
    {
        return [
            'score' => $this->client->get($package)['final'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('score', $properties['score']);
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
            '/npms/final-score/chalk' => 'final score',
        ];
    }
}
