<?php

declare(strict_types=1);

namespace App\Badges\LGTM\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class LinesBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/lgtm/lines/{provider}/{project}/{language?}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::ANALYSIS,
    ];

    /**
     * The deprecation dates and reasons.
     *
     * @var array<string, string>
     */
    protected array $deprecated = [
        '2023-03-18' => 'Deprecated due to the deprecation of required APIs.',
    ];

    public function handle(string $provider, string $project, ?string $language = null): array
    {
        $response = $this->client->get($provider, $project, $language);

        return [
            'lines' => $language ? $response['lines'] : \array_reduce($response['languages'], fn ($accu, $curr) => $accu + $curr['lines'], 0),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderLines($properties['lines']);
    }

    public function routeConstraints(Route $route): void
    {
        $route->whereIn('provider', ['github', 'bitbucket', 'gitlab']);
        $route->where('project', RoutePattern::CATCH_ALL->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/lgtm/lines/github/apache/cloudstack/java' => 'lines (java)',
        ];
    }
}
