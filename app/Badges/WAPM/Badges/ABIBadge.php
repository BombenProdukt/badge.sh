<?php

declare(strict_types=1);

namespace App\Badges\WAPM\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class ABIBadge extends AbstractBadge
{
    public function handle(string $package): array
    {
        return [
            'abis' => collect($this->client->get($package)['modules'])->map->abi->sort(),
        ];
    }

    public function render(array $properties): array
    {
        return [
            'label' => 'abi',
            'message' => \implode(' | ', $properties['abis']),
            'messageColor' => $properties['abis'] ? 'blue.600' : 'green.600',
        ];
    }

    public function keywords(): array
    {
        return [Category::PLATFORM_SUPPORT];
    }

    public function routePaths(): array
    {
        return [
            '/wapm/abi/{package}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('package', RoutePattern::CATCH_ALL->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/wapm/abi/jwmerrill/lox-repl' => 'abi',
            '/wapm/abi/kherrick/pwgen' => 'abi',
        ];
    }
}
