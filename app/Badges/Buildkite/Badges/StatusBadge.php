<?php

declare(strict_types=1);

namespace App\Badges\Buildkite\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Buildkite\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;

final class StatusBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $identifier, ?string $branch = null): array
    {
        return $this->renderStatus('build', $this->client->status($identifier, $branch));
    }

    public function service(): string
    {
        return 'Buildkite';
    }

    public function keywords(): array
    {
        return [Category::BUILD];
    }

    public function routePaths(): array
    {
        return [
            '/buildkite/status/{identifier}/{branch?}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        //
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/buildkite/status/3826789cf8890b426057e6fe1c4e683bdf04fa24d498885489'        => 'build status',
            '/buildkite/status/3826789cf8890b426057e6fe1c4e683bdf04fa24d498885489/master' => 'build status',
        ];
    }
}
