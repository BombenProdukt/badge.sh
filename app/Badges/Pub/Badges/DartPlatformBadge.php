<?php

declare(strict_types=1);

namespace App\Badges\Pub\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class DartPlatformBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/pub/dart-platform/{package}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::PLATFORM_SUPPORT,
    ];

    public function handle(string $package): array
    {
        $pubScores = $this->client->api("packages/{$package}/metrics")['scorecard'];

        return [
            'versions' => $this->parseTags($pubScores['panaReport']['derivedTags'], 'sdk'),
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'dart',
            'message' => $properties['versions'] ? \implode('|', $properties['versions']) : 'unknown',
            'messageColor' => $properties['versions'] ? 'blue.600' : 'gray.600',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('package', RoutePattern::CATCH_ALL->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/pub/dart-platform/rxdart' => 'dart-platform',
            '/pub/dart-platform/google_sign_in' => 'dart-platform',
        ];
    }

    private function parseTags(array $tags, string $group): array
    {
        $types = [];

        foreach ($tags as $tag) {
            if (!\str_starts_with($tag, $group.':')) {
                continue;
            }
            [, $name] = \explode(':', $tag);
            [$type] = \explode('-', $name);
            $types[] = $type;
        }

        return \array_values(\array_unique($types));
    }
}
