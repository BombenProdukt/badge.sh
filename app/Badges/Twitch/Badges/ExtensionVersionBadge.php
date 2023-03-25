<?php

declare(strict_types=1);

namespace App\Badges\Twitch\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class ExtensionVersionBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/twitch/extension-version/{appId}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::VERSION,
    ];

    public function handle(string $appId): array
    {
        return $this->client->extension($appId);
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version']);
    }

    public function routeConstraints(Route $route): void
    {
        //
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/twitch/extension-version/2nq5cu1nc9f4p75b791w8d3yo9d195' => 'version',
        ];
    }
}
