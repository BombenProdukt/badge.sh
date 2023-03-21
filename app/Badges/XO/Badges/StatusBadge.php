<?php

declare(strict_types=1);

namespace App\Badges\XO\Badges;

use App\Badges\AbstractBadge;
use App\Badges\XO\Client;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class StatusBadge extends AbstractBadge
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
            'label'        => 'code style',
            'message'      => 'XO',
            'messageColor' => '5ED9C7',
        ];
    }

    public function service(): string
    {
        return 'XO';
    }

    public function title(): string
    {
        return 'code style';
    }

    public function keywords(): array
    {
        return [Category::CODE_FORMATTING];
    }

    public function routePaths(): array
    {
        return [
            '/xo/status/{name}',
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
                'label'        => 'code style',
                'message'      => 'XO',
                'messageColor' => '5ED9C7',
            ],
        ];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/xo/status/chalk'                 => 'status',
            '/xo/status/@tusbar/cache-control' => 'status',
        ];
    }
}
