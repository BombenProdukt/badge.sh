<?php

declare(strict_types=1);

namespace App\Badges\FreeCodeCamp\Badges;

use App\Badges\FreeCodeCamp\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class PointsBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $username): array
    {
        return [
            'label'        => 'freecodecamp',
            'message'      => FormatNumber::execute($this->client->get($username)['entities']['user'][$username]['points']),
            'messageColor' => 'green.600',
        ];
    }

    public function service(): string
    {
        return 'FreeCodeCamp';
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
            '/freecodecamp/{username}/points',
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
        //
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
            '/appveyor/gruntjs/grunt/status'           => 'build',
            '/appveyor/gruntjs/grunt/status/deprecate' => 'build (branch)',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
