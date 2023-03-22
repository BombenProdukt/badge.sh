<?php

declare(strict_types=1);

namespace App\Badges\WordPress\Badges;

use App\Badges\AbstractBadge;
use App\Badges\WordPress\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class NameBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $extensionType, string $extension): array
    {
        return $this->renderDownloads($this->client->info($extensionType, $extension)['version']);
    }

    public function service(): string
    {
        return 'WordPress';
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/wordpress/{extensionType}/version/{extension}',
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
            '/wordpress/plugin/version/bbpress'        => 'version (plugin)',
            '/wordpress/theme/version/twentyseventeen' => 'version (theme)',
        ];
    }
}
