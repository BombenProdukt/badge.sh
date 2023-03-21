<?php

declare(strict_types=1);

namespace App\Badges\GitLab\Badges;

use App\Badges\GitLab\Client;
use App\Badges\Templates\LicenseTemplate;
use App\Contracts\Badge;
use App\Enums\RoutePattern;
use Illuminate\Routing\Route;

final class LicenseBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $repo): array
    {
        $response = $this->client->rest($repo, '?license=true');

        return LicenseTemplate::make($response->json('license.name'));
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
            '/gitlab/license/{repo}',
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
            '/gitlab/license/gitlab-org/omnibus-gitlab' => 'license',

        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
