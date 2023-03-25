<?php

declare(strict_types=1);

namespace App\Badges\WAPM\Badges;

use App\Data\BadgePreviewData;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class ABIBadge extends AbstractBadge
{
    protected array $routes = [
        '/wapm/abi/{package}',
    ];

    protected array $keywords = [
        Category::PLATFORM_SUPPORT,
    ];

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

    public function routeConstraints(Route $route): void
    {
        $route->where('package', RoutePattern::CATCH_ALL->value);
    }

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'abi',
                path: '/wapm/abi/jwmerrill/lox-repl',
                data: $this->render(['abis' => ['wasm32-unknown-unknown']]),
            ),
            new BadgePreviewData(
                name: 'abi',
                path: '/wapm/abi/kherrick/pwgen',
                data: $this->render(['abis' => []]),
            ),
        ];
    }
}
