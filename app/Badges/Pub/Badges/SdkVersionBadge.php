<?php

declare(strict_types=1);

namespace App\Badges\Pub\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class SdkVersionBadge extends AbstractBadge
{
    public function handle(string $package): array
    {
        $version = $this->client->api("packages/{$package}")['latest']['pubspec']['environment']['sdk'];

        return $this->renderVersion($version, 'dart sdk');
    }

    public function keywords(): array
    {
        return [Category::PLATFORM_SUPPORT];
    }

    public function routePaths(): array
    {
        return [
            '/pub/sdk-version/{package}',
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
            '/pub/sdk-version/uuid' => 'sdk-version',
        ];
    }
}
