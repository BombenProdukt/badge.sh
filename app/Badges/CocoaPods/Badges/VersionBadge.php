<?php

declare(strict_types=1);

namespace App\Badges\CocoaPods\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class VersionBadge extends AbstractBadge
{
    public function handle(string $pod): array
    {
        $response = $this->client->get($pod);

        return $this->renderVersion($response['version']);
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/cocoapods/version/{pod}',
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
            '/cocoapods/version/AFNetworking' => 'version',
        ];
    }
}
