<?php

declare(strict_types=1);

namespace App\Badges\Badgesize\Badges;

use App\Data\BadgePreviewData;
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

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'normal size',
                path: '/badgesize/normal/amio/emoji.json/master/emoji-compact.json',
                data: $this->render(['compression' => 'normal', 'size' => '7.03 kB', 'color' => 'blue.600']),
            ),
            new BadgePreviewData(
                name: 'gzip size',
                path: '/badgesize/gzip/amio/emoji.json/master/emoji-compact.json',
                data: $this->render(['compression' => 'normal', 'size' => '7.03 kB', 'color' => 'blue.600']),
            ),
            new BadgePreviewData(
                name: 'brotli size',
                path: '/badgesize/brotli/amio/emoji.json/master/emoji-compact.json',
                data: $this->render(['compression' => 'normal', 'size' => '7.03 kB', 'color' => 'blue.600']),
            ),
        ];
    }
}
