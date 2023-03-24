<?php

declare(strict_types=1);

namespace App\Badges\Clojars\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class VersionBadge extends AbstractBadge
{
    public function handle(string $clojar): array
    {
        $response = $this->client->get($clojar);

        return $this->renderVersion($response['latest_release'] ?? $response['latest_version']);
    }

    public function keywords(): array
    {
        return [Category::VERSION];
    }

    public function routePaths(): array
    {
        return [
            '/clojars/version/{clojar}',
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
            '/clojars/version/prismic' => 'version',
        ];
    }
}
