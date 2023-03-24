<?php

declare(strict_types=1);

namespace App\Badges\Badgesize\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class UrlBadge extends AbstractBadge
{
    public function handle(string $compression, string $path): array
    {
        $response = $this->client->get($compression, 'https:/'.str_replace(['https://', 'https/'], '', $path));

        return [
            'color'       => $response['color'],
            'compression' => $compression,
            'size'        => $response['prettySize'],
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label'        => $properties['compression'] === 'normal' ? 'size' : $properties['compression'].' size',
            'message'      => $properties['size'],
            'messageColor' => $properties['color'],
        ];
    }

    public function keywords(): array
    {
        return [Category::SIZE];
    }

    public function routePaths(): array
    {
        return [
            '/badgesize/{compression}/file-url/{path}',
            '/badgesize/{compression}/{path}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->whereIn('compression', ['brotli', 'gzip', 'normal']);
        $route->where('path', RoutePattern::CATCH_ALL->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/badgesize/normal/file-url/https/unpkg.com/snarkdown/dist/snarkdown.js' => 'arbitrary url',
            '/badgesize/normal/file-url/unpkg.com/snarkdown/dist/snarkdown.js'       => 'arbitrary url',
        ];
    }
}
