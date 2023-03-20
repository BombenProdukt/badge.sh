<?php

declare(strict_types=1);

namespace App\Badges\Buildkite\Badges;

use App\Badges\Buildkite\Client;
use App\Badges\Templates\StatusTemplate;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class StatusBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $identifier, ?string $branch = null): array
    {
        return StatusTemplate::make('build', $this->client->status($identifier, $branch));
    }

    public function service(): string
    {
        return 'Buildkite';
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
            '/buildkite/{identifier}/{branch?}',
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
            '/buildkite/3826789cf8890b426057e6fe1c4e683bdf04fa24d498885489'        => 'build status',
            '/buildkite/3826789cf8890b426057e6fe1c4e683bdf04fa24d498885489/master' => 'build status',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}