<?php

declare(strict_types=1);

namespace App\Badges\FDroid\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class VersionBadge extends AbstractBadge
{
    public function handle(string $appId): array
    {
        return [
            'version' => $this->client->get($appId)['CurrentVersion'],
        ];
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
            '/f-droid/{appId}/version',
        ];
    }

    public function routeParameters(): array
    {
        return [
            //
        ];
    }

    public function routeConstraints(Route $route): void
    {
        //
    }

    public function staticPreviews(): array
    {
        return [
            //
        ];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/f-droid/org.schabi.newpipe/version'    => 'version',
            '/f-droid/com.amaze.filemanager/version' => 'version',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
