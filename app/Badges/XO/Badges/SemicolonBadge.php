<?php

declare(strict_types=1);

namespace App\Badges\XO\Badges;

use App\Badges\AbstractBadge;
use App\Badges\XO\Client;
use App\Enums\Keyword;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;
use Illuminate\Support\Arr;

final class SemicolonBadge extends AbstractBadge
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
            'label'        => 'semicolons',
            'message'      => Arr::get($response, 'xo.semicolon') ? 'enabled' : 'disabled',
            'messageColor' => '5ED9C7',
        ];
    }

    public function service(): string
    {
        return 'XO';
    }

    public function title(): string
    {
        return 'semicolon';
    }

    public function keywords(): array
    {
        return [Keyword::CODE_STYLE];
    }

    public function routePaths(): array
    {
        return [
            '/xo/semicolon/{name}',
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
                'label'        => 'semicolons',
                'message'      => 'enabled',
                'messageColor' => '5ED9C7',
            ],
            [
                'label'        => 'semicolons',
                'message'      => 'disabled',
                'messageColor' => '5ED9C7',
            ],
        ];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/xo/semicolon/chalk'                 => 'semicolon',
            '/xo/semicolon/@tusbar/cache-control' => 'semicolon',
        ];
    }
}
