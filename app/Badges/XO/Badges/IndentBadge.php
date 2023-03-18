<?php

declare(strict_types=1);

namespace App\Badges\XO\Badges;

use App\Badges\XO\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class IndentBadge implements Badge
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
            'label'       => 'xo',
            'status'      => $this->getIndent($response['xo']['space'] ?? false),
            'statusColor' => '5ed9c7',
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
        return [];
    }

    public function routePaths(): array
    {
        return [
            '/xo/indent/{name}',
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
        $route->where('name', '.+');
    }

    public function staticPreviews(): array
    {
        return [
            [
                'label'       => 'xo',
                'status'      => 'tab',
                'statusColor' => '5ed9c7',
            ],
            [
                'label'       => 'xo',
                'status'      => '2 spaces',
                'statusColor' => '5ed9c7',
            ],
            [
                'label'       => 'xo',
                'status'      => '1 space',
                'statusColor' => '5ed9c7',
            ],
            [
                'label'       => 'xo',
                'status'      => '4 spaces',
                'statusColor' => '5ed9c7',
            ],
        ];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/xo/indent/chalk'                 => 'indent',
            '/xo/indent/@tusbar/cache-control' => 'indent',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
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
