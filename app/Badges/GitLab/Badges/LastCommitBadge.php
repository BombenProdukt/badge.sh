<?php

declare(strict_types=1);

namespace App\Badges\GitLab\Badges;

use App\Badges\AbstractBadge;
use App\Badges\GitLab\Client;
use App\Enums\Category;
use App\Enums\RoutePattern;
use Carbon\Carbon;
use Illuminate\Routing\Route;

final class LastCommitBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $repo, ?string $ref = null): array
    {
        $response = $this->client->rest($repo, $ref ? "repository/commits?ref={$ref}" : 'repository/commits')->json('0');

        return [
            'label'        => 'last commit',
            'message'      => Carbon::parse($response['committed_date'])->diffForHumans(),
            'messageColor' => 'green.600',
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
        return [Category::ACTIVITY];
    }

    public function routePaths(): array
    {
        return [
            '/gitlab/last-commit/{repo}/{ref?}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->where('repo', RoutePattern::CATCH_ALL->value);
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [
            '/gitlab/last-commit/gitlab-org/gitlab-development-kit'                                  => 'last commit',
            '/gitlab/last-commit/gitlab-org/gitlab-development-kit/updating-chromedriver-install-v2' => 'last commit (branch ref)',
            '/gitlab/last-commit/gitlab-org/gitlab-development-kit/v0.2.5'                           => 'last commit (tag ref)',
        ];
    }
}
