<?php

declare(strict_types=1);

namespace App\Badges\Mastodon\Badges;

use App\Actions\FormatNumber;
use App\Badges\Mastodon\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class UserIdBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $userId, ?string $instance = 'mastodon.social'): array
    {
        $response = $this->client->get($instance, "accounts/{$userId}");
        $account  = $response['username']."@{$instance}";

        return [
            'label'       => "follow @{$account}",
            'status'      => FormatNumber::execute($response['followers_count']),
            'statusColor' => '3487CE',
        ];
    }

    public function service(): string
    {
        return 'Mastodon';
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
            '/mastodon/follow/{userId}/{instance?}',
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
        $route->whereNumber('userId');
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
            //
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}
