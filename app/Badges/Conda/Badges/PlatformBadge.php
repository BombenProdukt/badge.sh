<?php

declare(strict_types=1);

namespace App\Badges\Conda\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class PlatformBadge extends AbstractBadge
{
    public function handle(string $channel, string $package): array
    {
        return $this->renderText('platforms', implode(' | ', $this->client->get($channel, $package)['conda_platforms']), 'blue.600');
    }

    public function keywords(): array
    {
        return [Category::PLATFORM_SUPPORT];
    }

    public function routePaths(): array
    {
        return [
            '/conda/platform/{channel}/{package}',
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
            '/conda/platform/conda-forge/python' => 'platform',
        ];
    }
}
