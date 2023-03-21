<?php

declare(strict_types=1);

namespace App\Badges\XO\Badges;

use App\Badges\AbstractBadge;
use App\Badges\XO\Client;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class IndentBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $name): array
    {
        $response = $this->client->get($name);

        if (empty($response['devDependencies']) || empty($response['devDependencies']['xo'])) {
            return [
                'label'        => 'xo',
                'message'      => 'not enabled',
                'messageColor' => 'gray.600',
            ];
        }

        return [
            'label'        => 'xo',
            'message'      => $this->getIndent($response['xo']['space'] ?? false),
            'messageColor' => '5ed9c7',
        ];
    }

    public function service(): string
    {
        return 'XO';
    }

    public function title(): string
    {
        return 'indent';
    }

    public function keywords(): array
    {
        return [Category::CODE_FORMATTING];
    }

    public function routePaths(): array
    {
        return [
            '/xo/indentation/{name}',
        ];
    }

    public function routeParameters(): array
    {
        return [
            'name' => 'The name of the package',
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
                'label'        => 'xo',
                'message'      => 'tab',
                'messageColor' => '5ed9c7',
            ],
            [
                'label'        => 'xo',
                'message'      => '2 spaces',
                'messageColor' => '5ed9c7',
            ],
            [
                'label'        => 'xo',
                'message'      => '1 space',
                'messageColor' => '5ed9c7',
            ],
            [
                'label'        => 'xo',
                'message'      => '4 spaces',
                'messageColor' => '5ed9c7',
            ],
        ];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/xo/indentation/chalk'                 => 'indentation',
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
