<?php

declare(strict_types=1);

namespace App\Badges\Pub\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Pub\Client;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class FlutterPlatformBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $package): array
    {
        $pubScores = $this->client->api("packages/{$package}/metrics")['scorecard'];
        $platforms = implode('|', $this->parseTags($pubScores['panaReport']['derivedTags'], 'platform'));

        return [
            'label'        => 'flutter',
            'message'      => $platforms ?? 'unknown',
            'messageColor' => $platforms ? 'blue.600' : 'gray.600',
        ];
    }

    public function service(): string
    {
        return 'Pub';
    }

    public function keywords(): array
    {
        return [Category::PLATFORM_SUPPORT];
    }

    public function routePaths(): array
    {
        return [
            '/pub/flutter-platform/{package}',
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
            '/pub/flutter-platform/xml' => 'flutter-platform',
        ];
    }

    private function parseTags(array $tags, string $group): array
    {
        $types = [];
        foreach ($tags as $tag) {
            if (! str_starts_with($tag, $group.':')) {
                continue;
            }
            [, $name] = explode(':', $tag);
            [$type]   = explode('-', $name);
            $types[]  = $type;
        }

        return array_values(array_unique($types));
    }
}
