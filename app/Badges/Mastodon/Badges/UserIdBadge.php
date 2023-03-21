<?php

declare(strict_types=1);

namespace App\Badges\Mastodon\Badges;

use App\Badges\AbstractBadge;
use App\Badges\Mastodon\Client;
use App\Enums\Category;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class UserIdBadge extends AbstractBadge
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
            'label'        => "follow @{$account}",
            'message'      => FormatNumber::execute($response['followers_count']),
            'messageColor' => '3487CE',
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
        return [Category::SOCIAL];
    }

    public function routePaths(): array
    {
        return [
            '/mastodon/follow/{userId}/{instance?}',
        ];
    }

    public function routeParameters(): array
    {
        return [];
    }

    public function routeConstraints(Route $route): void
    {
        $route->whereNumber('userId');
    }

    public function staticPreviews(): array
    {
        return [];
    }

    public function dynamicPreviews(): array
    {
        return [];
    }
}
