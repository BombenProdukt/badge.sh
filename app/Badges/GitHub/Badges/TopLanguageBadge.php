<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Enums\Category;
use GrahamCampbell\GitHub\Facades\GitHub;
use Illuminate\Routing\Route;

final class TopLanguageBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/github/top-language/{owner}/{repo}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::ANALYSIS,
    ];

    public function handle(string $owner, string $repo): array
    {
        $languages = GitHub::repos()->languages($owner, $repo);

        return [
            'label' => \array_key_first($languages),
            'value' => head($languages),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber($properties['label'], $properties['value']);
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
            '/github/top-language/micromatch/micromatch' => 'top language',
        ];
    }
}
