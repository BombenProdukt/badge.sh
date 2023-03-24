<?php

declare(strict_types=1);

namespace App\Badges\Twitch\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class ExtensionVersionBadge extends AbstractBadge
{
    public function handle(string $appId): array
    {
        return $this->client->extension($appId);
    }

    public function render(array $properties): array
    {
        return $this->renderVersion($properties['version']);
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/twitch/extension-version/{appId}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
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
