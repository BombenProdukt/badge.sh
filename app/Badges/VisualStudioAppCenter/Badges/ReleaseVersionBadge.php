<?php

declare(strict_types=1);

namespace App\Badges\VisualStudioAppCenter\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class ReleaseVersionBadge extends AbstractBadge
{
    public function handle(string $owner, string $app, string $token): array
    {
        return [
            'version' => $this->client->releases($owner, $app, $token)['short_version'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderSize($properties['version']);
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/visual-studio-app-center/version/{owner}/{app}/{token}',
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
            '/visual-studio-app-center/version/jct/my-amazing-app/ac70cv...' => 'version',
        ];
    }
}
