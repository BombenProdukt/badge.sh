<?php

declare(strict_types=1);

namespace App\Badges\Travis\Badges;

use App\Badges\Travis\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;
use Illuminate\Support\Collection;

final class StatusBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $owner, string $repo, ?string $branch = null): array
    {
        $org = $this->client->org($owner, $repo, $branch);
        $com = $this->client->com($owner, $repo, $branch);

        $result = $this->availableStates()->firstWhere(fn (array $state) => str_contains($org, $state[0]) || str_contains($com, $state[0]));

        return [
            'label'       => 'travis',
            'status'      => $result[0],
            'statusColor' => $result[1],
        ];
    }

    public function service(): string
    {
        return 'Travis';
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
            '/travis/{owner}/{repo}/{branch?}',
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
            '/travis/babel/babel'     => 'build',
            '/travis/babel/babel/6.x' => 'build (branch)',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
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
