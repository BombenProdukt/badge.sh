<?php

declare(strict_types=1);

namespace App\Badges\Pub\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class FlutterPlatformBadge extends AbstractBadge
{
    protected array $routes = [
        '/pub/flutter-platform/{package}',
    ];

    protected array $keywords = [
        Category::PLATFORM_SUPPORT,
    ];

    public function handle(string $package): array
    {
        $pubScores = $this->client->api("packages/{$package}/metrics")['scorecard'];

        return [
            'platforms' => $this->parseTags($pubScores['panaReport']['derivedTags'], 'platform'),
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'flutter',
            'message' => $properties['platforms'] ? \implode('|', $properties['platforms']) : 'unknown',
            'messageColor' => $properties['platforms'] ? 'blue.600' : 'gray.600',
        ];
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
            '/pub/flutter-platform/xml' => 'flutter-platform',
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
