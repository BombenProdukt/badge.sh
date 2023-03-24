<?php

declare(strict_types=1);

namespace App\Badges\VisualStudioAppCenter\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class BuildsBadge extends AbstractBadge
{
    public function handle(string $owner, string $app, string $branch, string $token): array
    {
        return [
            'status' => $this->client->builds($owner, $app, $branch, $token),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderStatus('build status', $properties['status']);
    }

    public function keywords(): array
    {
        return [Category::BUILD];
    }

    public function routePaths(): array
    {
        return [
            '/visual-studio-app-center/builds/{owner}/{app}/{branch}/{token}',
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
            '/visual-studio-app-center/builds/jct/my-amazing-app/master/ac70cv...' => 'builds',
        ];
    }
}
