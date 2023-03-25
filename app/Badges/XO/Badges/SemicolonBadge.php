<?php

declare(strict_types=1);

namespace App\Badges\XO\Badges;

use App\Enums\Keyword;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;
use Illuminate\Support\Arr;

final class SemicolonBadge extends AbstractBadge
{
    protected array $routes = [
        '/xo/semicolon/{name}',
    ];

    protected array $keywords = [
        Keyword::CODE_STYLE,
    ];

    public function handle(string $name): array
    {
        $response = $this->client->get($name);

        if (empty($response['devDependencies']) || empty($response['devDependencies']['xo'])) {
            return [];
        }

        return [
            'semicolons' => Arr::get($response, 'xo.semicolon') ? 'enabled' : 'disabled',
        ];
    }

    public function render(array $properties): array
    {
        if (empty($properties['semicolons'])) {
            return [
                'label' => 'xo',
                'message' => 'not enabled',
                'messageColor' => 'gray.600',
            ];
        }

        return [
            'label' => 'semicolons',
            'message' => $properties['semicolons'],
            'messageColor' => '5ED9C7',
        ];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('name', RoutePattern::CATCH_ALL->value);
    }

    public function staticPreviews(): array
    {
        return [
            [
                'label' => 'semicolons',
                'message' => 'enabled',
                'messageColor' => '5ED9C7',
            ],
            [
                'label' => 'semicolons',
                'message' => 'disabled',
                'messageColor' => '5ED9C7',
            ],
        ];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/xo/semicolon/chalk' => 'semicolon',
            '/xo/semicolon/@tusbar/cache-control' => 'semicolon',
        ];
    }
}
