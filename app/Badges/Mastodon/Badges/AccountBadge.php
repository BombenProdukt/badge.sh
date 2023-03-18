<?php

declare(strict_types=1);

namespace App\Badges\Mastodon\Badges;

use App\Badges\Mastodon\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;

final class AccountBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $account): array
    {
        [$username, $instance] = explode('@', $account);
        $version               = $this->client->get($instance, 'instance')['version'];

        if (preg_match('/\bPleroma\b/i', $version) !== 0) {
            return (new UserIdBadge($this->client))->handle($username, $instance);
        }

        $userId = $this->parseFeed($this->client->rss($instance, $username));

        if (is_string($userId)) {
            return (new UserIdBadge($this->client))->handle($userId, $instance);
        }

        return [
            'label'       => 'TODO',
            'status'      => 'TODO',
            'statusColor' => 'TODO',
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

        ];
    }

    public function routePaths(): array
    {
        return [
            '/mastodon/follow/{account}',
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
            '/mastodon/follow/Gargron@mastodon.social' => 'followers',
            '/mastodon/follow/trumpet@mas.to'          => 'followers',
            '/mastodon/follow/admin@cawfee.club'       => 'followers (Pleroma)',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }

    private function parseFeed(string $feed): ?string
    {
        if (preg_match('/\/accounts\/avatars\/(\d{3})\/(\d{3})\/(\d{3})/', $feed, $matches)) {
            return implode('', array_slice($matches, 1));
        }

        return null;
    }
}
