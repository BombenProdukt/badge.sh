<?php

declare(strict_types=1);

namespace App\Badges\Twitter\Badges;

use App\Badges\Twitter\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class FollowBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $username): array
    {
        $response = $this->client->get($username);

        return [
            'label'        => "follow @{$username}",
            'message'      => FormatNumber::execute($response['followers_count']),
            'messageColor' => '1da1f2',
        ];
    }

    public function service(): string
    {
        return 'Twitter';
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
            '/twitter/{username}/follow',
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
        //
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
            '/twitter/rustlang/follow' => 'followers count',
            '/twitter/golang/follow'   => 'followers count',
        ];
    }

    public function deprecated(): array
    {
        return [
            '2023-03-18' => 'Deprecated due to the deprecation of required APIs.',
        ];
    }
}