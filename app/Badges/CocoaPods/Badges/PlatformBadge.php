<?php

declare(strict_types=1);

namespace App\Badges\CocoaPods\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;

final class PlatformBadge extends AbstractBadge
{
    public function handle(string $pod): array
    {
        return [
            'platforms' => array_keys($this->client->get($pod)['platforms']),
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderText('platforms', implode(' | ', $properties['platforms']), 'blue.600');
    }

    public function keywords(): array
    {
        return [Category::PLATFORM_SUPPORT];
    }

    public function routePaths(): array
    {
        return [
            '/cocoapods/platform/{pod}',
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
            '/cocoapods/platform/AFNetworking' => 'platform',
        ];
    }
}
