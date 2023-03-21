<?php

declare(strict_types=1);

namespace App\Badges\DavidDM\Badges;

use App\Badges\DavidDM\Client;
use App\Contracts\Badge;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class DevBadge implements Badge
{
    private array $statusInfo = [
        'insecure'      => ['insecure', 'red'],
        'outofdate'     => ['out of date', 'orange'],
        'notsouptodate' => ['up to date', 'yellow'],
        'uptodate'      => ['up to date', 'green'],
        'none'          => ['none', 'green'],
    ];

    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $repo, string $path): array
    {
        $status = $this->client->get($repo, $path, 'dev-')['status'];

        return [
            'label'        => 'devDependencies',
            'message'      => $this->statusInfo[$status][0],
            'messageColor' => $this->statusInfo[$status][1],
        ];
    }

    public function service(): string
    {
        return 'DavidDM';
    }

    public function title(): string
    {
        return '';
    }

    public function keywords(): array
    {
        return [
            //
        ];
    }

    public function routePaths(): array
    {
        return [
            '/david/dev/{repo}/{path?}',
        ];
    }

    public function routeParameters(): array
    {
        return [
            //
        ];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('repo', RoutePattern::CATCH_ALL->value);
        $route->where('path', RoutePattern::CATCH_ALL->value);
    }

    public function staticPreviews(): array
    {
        return [
            //
        ];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/david/dev/zeit/pkg' => 'dev dependencies',
        ];
    }

    public function deprecated(): array
    {
        return [
            '2023-03-18' => 'Deprecated due to the deprecation of required APIs.',
        ];
    }
}
