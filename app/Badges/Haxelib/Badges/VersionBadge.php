<?php

declare(strict_types=1);

namespace App\Badges\Haxelib\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class VersionBadge extends AbstractBadge
{
    public function handle(string $project): array
    {
        $response = $this->client->get($project);

        return $this->renderVersion('TODO');
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/haxelib/version/{project}',
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
            '/haxelib/version/tink_http' => 'version',
            '/haxelib/version/nme'       => 'version',
        ];
    }
}
