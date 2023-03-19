<?php

declare(strict_types=1);

namespace App\Badges\CircleCI\Badges;

use App\Badges\CircleCI\Client;
use App\Contracts\Badge;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class StatusBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $vcs, string $repo, ?string $branch = null): array
    {
        $status = $this->client->get($vcs, $repo, $branch)[0]['status'];

        return [
            'label'        => 'circleci',
            'message'      => str_replace('_', ' ', $status),
            'messageColor' => ['failed'  => 'red.600', 'success' => 'green.600'][$status] ?? 'gray.600',
        ];
    }

    public function service(): string
    {
        return 'CircleCI';
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
            '/circleci/{vcs}/{repo}/status/{branch?}',
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
        $route->whereIn('vcs', ['github', 'gitlab']);
        $route->where('repo', RoutePattern::PACKAGE_WITH_VENDOR_ONLY->value);
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
            '/circleci/github/circleci/ex/status'      => 'build',
            '/circleci/github/circleci/ex/status/main' => 'build (branch)',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
