<?php

declare(strict_types=1);

namespace App\Badges\XO\Badges;

use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class IndentBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/xo/indentation/{name}',
    ];

    /**
     * The keywords that describe this badge.
     *
     * @var array<int, string>
     */
    protected array $keywords = [
        Category::CODE_FORMATTING,
    ];

    public function handle(string $name): array
    {
        $response = $this->client->get($name);

        if (empty($response['devDependencies']) || empty($response['devDependencies']['xo'])) {
            return [];
        }

        return [
            'indentation' => $this->getIndent($response['xo']['space'] ?? false),
        ];
    }

    public function render(array $properties): array
    {
        if (empty($properties['indentation'])) {
            return [
                'label' => 'xo',
                'message' => 'not enabled',
                'messageColor' => 'gray.600',
            ];
        }

        return [
            'label' => 'indentation',
            'message' => $properties['indentation'],
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
                'label' => 'xo',
                'message' => 'tab',
                'messageColor' => '5ed9c7',
            ],
            [
                'label' => 'xo',
                'message' => '2 spaces',
                'messageColor' => '5ed9c7',
            ],
            [
                'label' => 'xo',
                'message' => '1 space',
                'messageColor' => '5ed9c7',
            ],
            [
                'label' => 'xo',
                'message' => '4 spaces',
                'messageColor' => '5ed9c7',
            ],
        ];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/xo/indentation/chalk' => 'indentation',
            '/xo/indentation/@tusbar/cache-control' => 'indentation',
        ];
    }

    private function getIndent(bool|int $space): string
    {
        if ($space === false) {
            return 'tab';
        }

        if ($space === true) {
            return '2 spaces';
        }

        if ($space === 1) {
            return '1 space';
        }

        return "{$space} spaces";
    }
}
