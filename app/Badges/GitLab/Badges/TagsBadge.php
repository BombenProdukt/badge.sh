<?php

declare(strict_types=1);

namespace App\Badges\GitLab\Badges;

use App\Badges\GitLab\Client;
use App\Contracts\Badge;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class TagsBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $repo): array
    {
        $response = $this->client->rest($repo, 'repository/tags');

        return [
            'label'        => 'tags',
            'message'      => FormatNumber::execute((int) $response->header('x-total')),
            'messageColor' => 'blue.600',
        ];
    }

    public function service(): string
    {
        return 'GitLab';
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
            '/gitlab/{repo}/tags',
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
            '/gitlab/commento/commento/tags' => 'tags',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}