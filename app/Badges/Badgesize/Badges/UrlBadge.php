<?php

declare(strict_types=1);

namespace App\Badges\Badgesize\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class UrlBadge extends AbstractBadge
{
    protected array $keywords = [
        Category::SIZE,
    ];

    public function handle(string $compression, string $path): array
    {
        $response = $this->client->get($compression, 'https:/'.\str_replace(['https://', 'https/'], '', $path));

        return [
            'color' => $response['color'],
            'compression' => $compression,
            'size' => $response['prettySize'],
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

    public function routePaths(): array
    {
        return [
            '/badgesize/{compression}/file-url/{path}',
            '/badgesize/{compression}/{path}',
        ];
    }

    public function routeConstraints(Route $route): void
    {
        $route->whereIn('compression', ['brotli', 'gzip', 'normal']);
        $route->where('path', RoutePattern::CATCH_ALL->value);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'arbitrary url',
                path: '/badgesize/normal/file-url/https/unpkg.com/snarkdown/dist/snarkdown.js',
                data: $this->render(['compression' => 'normal', 'size' => '7.03 kB', 'color' => '3487CE']),
            ),
            new BadgePreviewData(
                name: 'arbitrary url',
                path: '/badgesize/normal/file-url/unpkg.com/snarkdown/dist/snarkdown.js',
                data: $this->render(['compression' => 'normal', 'size' => '7.03 kB', 'color' => '3487CE']),
            ),
        ];
    }
}
