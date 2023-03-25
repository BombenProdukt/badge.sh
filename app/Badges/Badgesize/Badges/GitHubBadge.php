<?php

declare(strict_types=1);

namespace App\Badges\Badgesize\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class GitHubBadge extends AbstractBadge
{
    protected array $routes = [
        '/badgesize/{compression}/{repo}/{path}',
    ];

    protected array $keywords = [
        Category::SIZE,
    ];

    public function handle(string $compression, string $repo, string $path): array
    {
        $response = $this->client->get($compression, "{$repo}/{$path}");

        return [
            'compression' => $compression,
            'size' => $response['prettySize'],
            'color' => $response['color'],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => $properties['compression'] === 'normal' ? 'size' : $properties['compression'].' size',
            'message' => $properties['size'],
            'messageColor' => $properties['color'],
        ];
    }

    public function routeConstraints(Route $route): void
    {
        $route->whereIn('compression', ['brotli', 'gzip', 'normal']);
        $route->where('repo', RoutePattern::CATCH_ALL->value);
        $route->where('path', RoutePattern::CATCH_ALL->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/badgesize/normal/amio/emoji.json/master/emoji-compact.json' => 'normal size',
            '/badgesize/gzip/amio/emoji.json/master/emoji-compact.json' => 'gzip size',
            '/badgesize/brotli/amio/emoji.json/master/emoji-compact.json' => 'brotli size',
        ];
    }
}
