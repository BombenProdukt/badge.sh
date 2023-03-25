<?php

declare(strict_types=1);

namespace App\Badges\WordPress\Badges;

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
            '/wordpress/plugin/author/bbpress' => 'version (plugin)',
            '/wordpress/theme/author/twentyseventeen' => 'version (theme)',
        ];
    }
}
