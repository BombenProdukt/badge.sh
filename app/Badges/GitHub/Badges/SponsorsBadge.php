<?php

declare(strict_types=1);

namespace App\Badges\GitHub\Badges;

use App\Enums\Category;
use GrahamCampbell\GitHub\Facades\GitHub;

final class SponsorsBadge extends AbstractBadge
{
    protected array $routes = [
        '/github/sponsors/{username}',
    ];

    protected array $keywords = [
        Category::FUNDING,
    ];

    public function handle(string $username): array
    {
        $response = GitHub::connection('graphql')->api('graphql')->execute('query ($user: String!) { repositoryOwner(login: $user) { ... on User { sponsorshipsAsMaintainer { totalCount } } ... on Organization { sponsorshipsAsMaintainer { totalCount } } } }', ['user' => $username]);

        return [
            'count' => $response['data']['repositoryOwner']['sponsorshipsAsMaintainer']['totalCount'],
        ];
    }

    public function render(array $properties): array
    {
        return $this->renderNumber('sponsors', $properties['count']);
    }

    public function previews(): array
    {
        return [
            '/github/sponsors/micromatch' => 'sponsors',
        ];
    }
}
