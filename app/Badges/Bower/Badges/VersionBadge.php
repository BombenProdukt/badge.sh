<?php

declare(strict_types=1);

namespace App\Badges\Bower\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class VersionBadge extends AbstractBadge
{
    public function handle(string $packageName, ?string $channel = 'latest'): array
    {
        $response = $this->client->get($packageName);

        return $this->renderVersion($response[$channel === 'latest' ? 'latest_stable_release_number' : 'latest_release_number'] ?? $response['latest_release_number']);
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/bower/version/{packageName}/{channel?}',
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
            '/bower/version/bootstrap' => 'version',
        ];
    }
}
