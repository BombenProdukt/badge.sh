<?php

declare(strict_types=1);

namespace App\Badges\WordPress\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class AuthorBadge extends AbstractBadge
{
    protected array $routes = [
        '/wordpress/{extensionType}/author/{extension}',
    ];

    protected array $keywords = [
        Category::SOCIAL,
    ];

    public function handle(string $extensionType, string $extension): array
    {
        return [
            'author' => $this->client->info($extensionType, $extension)['author']['user_nicename'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderText('author', $properties['author']);
    }

    public function routeConstraints(Route $route): void
    {
        $route->whereIn('extensionType', ['plugin', 'theme']);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'version (plugin)',
                path: '/wordpress/plugin/author/bbpress',
                data: $this->render([]),
            ),
            new BadgePreviewData(
                name: 'version (theme)',
                path: '/wordpress/theme/author/twentyseventeen',
                data: $this->render([]),
            ),
        ];
    }
}
