<?php

declare(strict_types=1);

namespace App\Badges\Pub\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class PopularityBadge extends AbstractBadge
{
    public function handle(string $package): array
    {
        $percentage = (float) $this->client->api("packages/{$package}/score")['popularityScore'];

        return $this->renderPercentage('popularity', $percentage * 100);
    }

    public function keywords(): array
    {
        return [Category::SOCIAL];
    }

    public function routePaths(): array
    {
        return [
            '/pub/popularity/{package}',
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
            '/pub/popularity/mobx' => 'popularity',
        ];
    }
}
