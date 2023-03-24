<?php

declare(strict_types=1);

namespace App\Badges\WordPress\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class CommunityBadge extends AbstractBadge
{
    public function handle(string $extensionType, string $extension): array
    {
        return $this->renderText('community', $this->client->info($extensionType, $extension)['is_community'] ? 'yes' : 'no');
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/wordpress/{extensionType}/community/{extension}',
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
            '/wordpress/plugin/community/bbpress'        => 'community status (plugin)',
            '/wordpress/theme/community/twentyseventeen' => 'community status (theme)',
        ];
    }
}
