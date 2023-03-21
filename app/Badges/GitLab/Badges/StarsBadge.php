<?php

declare(strict_types=1);

namespace App\Badges\GitLab\Badges;

use App\Badges\GitLab\Client;
use App\Contracts\Badge;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class StarsBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $repo): array
    {
        $response = $this->client->graphql($repo, 'starCount');

        return [
            'label'        => 'stars',
            'message'      => FormatNumber::execute($response['starCount']),
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
            '/gitlab/stars/{repo}',
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
            '/gitlab/stars/fdroid/fdroidclient' => 'stars',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
