<?php

declare(strict_types=1);

namespace App\Badges\WordPress\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class AuthorBadge extends AbstractBadge
{
    public function handle(string $extensionType, string $extension): array
    {
        return $this->renderText('author', $this->client->info($extensionType, $extension)['author']['user_nicename']);
    }

    public function keywords(): array
    {
        return [Category::SOCIAL];
    }

    public function routePaths(): array
    {
        return [
            '/wordpress/{extensionType}/author/{extension}',
        ];
    }

    public function routeConstraints(Route $route): void
    {
        $route->whereIn('extensionType', ['plugin', 'theme']);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/wordpress/plugin/author/bbpress'        => 'version (plugin)',
            '/wordpress/theme/author/twentyseventeen' => 'version (theme)',
        ];
    }
}
