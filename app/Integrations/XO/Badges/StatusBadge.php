<?php

declare(strict_types=1);

namespace App\Integrations\XO\Badges;

use App\Integrations\Contracts\Badge;
use App\Integrations\XO\Client;
use Illuminate\Routing\Route;

final class StatusBadge implements Badge
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
            'label'       => 'code style',
            'status'      => 'XO',
            'statusColor' => '5ED9C7',
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
        return [];
    }

    public function routePaths(): array
    {
        return ['/xo/status/{name}'];
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
                'label'       => 'code style',
                'status'      => 'XO',
                'statusColor' => '5ED9C7',
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
