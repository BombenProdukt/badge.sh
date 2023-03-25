<?php

declare(strict_types=1);

namespace App\Badges\Haxelib\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class LatestDownloadsBadge extends AbstractBadge
{
    public function handle(string $project): array
    {
        return $this->client->get($project);
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'TODO',
            'message' => 'TODO',
            'messageColor' => 'TODO',
        ];
    }

    public function keywords(): array
    {
        return [Category::DOWNLOADS];
    }

    public function routePaths(): array
    {
        return [
            '/haxelib/downloads-recently/{project}',
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
            '/haxelib/downloads-recently/hxnodejs' => 'downloads (latest version)',
        ];
    }
}
