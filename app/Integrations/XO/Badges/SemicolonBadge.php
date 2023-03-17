<?php

declare(strict_types=1);

namespace App\Integrations\XO\Badges;

use App\Enums\Keyword;
use App\Integrations\Contracts\Badge;
use App\Integrations\XO\Client;
use Illuminate\Routing\Route;
use Illuminate\Support\Arr;

final class SemicolonBadge implements Badge
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
                'label'       => 'xo',
                'status'      => 'not enabled',
                'statusColor' => 'gray.600',
            ];
        }

        return [
            'label'       => 'semicolons',
            'status'      => Arr::get($response, 'xo.semicolon') ? 'enabled' : 'disabled',
            'statusColor' => '5ED9C7',
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
        return ['/xo/semi/{name}'];
    }

    public function routeParameters(): array
    {
        return [
            'name' => 'The name of the package',
        ];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('name', '.+');
    }

    public function staticPreviews(): array
    {
        return [
            [
                'label'       => 'semicolons',
                'status'      => 'enabled',
                'statusColor' => '5ED9C7',
            ],
            [
                'label'       => 'semicolons',
                'status'      => 'disabled',
                'statusColor' => '5ED9C7',
            ],
        ];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/xo/semi/chalk'                 => 'semicolon',
            '/xo/semi/@tusbar/cache-control' => 'semicolon',
        ];
    }
}
