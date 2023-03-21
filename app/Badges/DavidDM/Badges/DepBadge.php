<?php

declare(strict_types=1);

namespace App\Badges\DavidDM\Badges;

use App\Badges\AbstractBadge;
use App\Badges\DavidDM\Client;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class DepBadge extends AbstractBadge
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
        $status = $this->client->get($repo, $path)['status'];

        return [
            'label'        => 'dependencies',
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
        return [];
    }

    public function routePaths(): array
    {
        return [
            '/david/dep/{repo}/{path?}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('repo', RoutePattern::CATCH_ALL->value);
        $route->where('path', RoutePattern::CATCH_ALL->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/david/dep/zeit/pkg'                       => 'dependencies',
            '/david/dep/babel/babel/packages/babel-cli' => 'dependencies (sub path)',
        ];
    }

    public function deprecated(): array
    {
        return [
            '2023-03-18' => 'Deprecated due to the deprecation of required APIs.',
        ];
    }
}
