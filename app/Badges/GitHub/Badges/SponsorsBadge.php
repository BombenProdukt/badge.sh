<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Badges\AbstractBadge;
use App\Badges\GitHub\Client;
use App\Badges\Templates\NumberTemplate;
use GrahamCampbell\GitHub\Facades\GitHub;
use Illuminate\Routing\Route;

final class SponsorsBadge extends AbstractBadge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $username): array
    {
        $response = GitHub::connection('graphql')->api('graphql')->execute('query ($user: String!) { repositoryOwner(login: $user) { ... on User { sponsorshipsAsMaintainer { totalCount } } ... on Organization { sponsorshipsAsMaintainer { totalCount } } } }', ['user' => $username]);

        return NumberTemplate::make('sponsors', $response['data']['repositoryOwner']['sponsorshipsAsMaintainer']['totalCount']);
    }

    public function service(): string
    {
        return 'GitHub';
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
