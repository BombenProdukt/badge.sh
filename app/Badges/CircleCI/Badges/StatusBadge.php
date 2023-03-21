<?php

declare(strict_types=1);

namespace App\Badges\CircleCI\Badges;

use App\Badges\AbstractBadge;
use App\Badges\CircleCI\Client;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class StatusBadge extends AbstractBadge
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
        return [];
    }

    public function routePaths(): array
    {
        return [
            '/circleci/status/{vcs}/{repo}/{branch?}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->whereIn('vcs', ['github', 'gitlab']);
        $route->where('repo', RoutePattern::PACKAGE_WITH_VENDOR_ONLY->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/circleci/status/github/circleci/ex'      => 'build',
            '/circleci/status/github/circleci/ex/main' => 'build (branch)',
        ];
    }
}
