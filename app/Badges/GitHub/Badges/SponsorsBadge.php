<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Enums\Category;
use GrahamCampbell\GitHub\Facades\GitHub;
use Illuminate\Routing\Route;

final class SponsorsBadge extends AbstractBadge
{
    public function handle(string $username): array
    {
        $response = GitHub::connection('graphql')->api('graphql')->execute('query ($user: String!) { repositoryOwner(login: $user) { ... on User { sponsorshipsAsMaintainer { totalCount } } ... on Organization { sponsorshipsAsMaintainer { totalCount } } } }', ['user' => $username]);

        return $this->renderNumber('sponsors', $response['data']['repositoryOwner']['sponsorshipsAsMaintainer']['totalCount']);
    }

    public function keywords(): array
    {
        return [Category::FUNDING];
    }

    public function routePaths(): array
    {
        return [
            '/github/sponsors/{username}',
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
            '/github/sponsors/micromatch' => 'sponsors',
        ];
    }
}
