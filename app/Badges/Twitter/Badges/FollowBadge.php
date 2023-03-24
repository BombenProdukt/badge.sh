<?php

declare(strict_types=1);

namespace App\Badges\Twitter\Badges;

use App\Enums\Category;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class FollowBadge extends AbstractBadge
{
    public function handle(string $username): array
    {
        $response = $this->client->get($username);

        return [
            'label'        => "follow @{$username}",
            'message'      => FormatNumber::execute($response['followers_count']),
            'messageColor' => '1da1f2',
        ];
    }

    public function keywords(): array
    {
        return [Category::SOCIAL];
    }

    public function routePaths(): array
    {
        return [
            '/twitter/follow/{username}',
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
            '/twitter/follow/rustlang' => 'followers count',
            '/twitter/follow/golang'   => 'followers count',
        ];
    }

    public function deprecated(): array
    {
        return [
            '2023-03-18' => 'Deprecated due to the deprecation of required APIs.',
        ];
    }
}
