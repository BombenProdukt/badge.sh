<?php

declare(strict_types=1);

namespace App\Badges\Travis\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Travis\Client;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;
use Illuminate\Support\Collection;

final class StatusBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $project, ?string $branch = null): array
    {
        $org = $this->client->org($project, $branch);
        $com = $this->client->com($project, $branch);

        $result = $this->availableStates()->firstWhere(fn (array $state) => str_contains($org, $state[0]) || str_contains($com, $state[0]));

        return [
            'label'        => 'travis',
            'message'      => $result[0],
            'messageColor' => $result[1],
        ];
    }

    public function service(): string
    {
        return 'Travis';
    }

    public function keywords(): array
    {
        return [Category::BUILD];
    }

    public function routePaths(): array
    {
        return [
            '/travis/status/{project}/{branch?}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('project', RoutePattern::CATCH_ALL->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/travis/status/babel/babel'     => 'build',
            '/travis/status/babel/babel/6.x' => 'build (branch)',
        ];
    }

    private function availableStates(): Collection
    {
        return collect([
            ['broken', 'red.600'],
            ['canceled', 'gray.600'],
            ['error', 'red.600'],
            ['errored', 'red.600'],
            ['failed', 'red.600'],
            ['failing', 'red.600'],
            ['fixed', 'yellow.600'],
            ['passed', 'green.600'],
            ['passing', 'green.600'],
            ['pending', 'yellow.600'],
        ]);
    }
}
