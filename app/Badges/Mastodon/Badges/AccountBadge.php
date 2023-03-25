<?php

declare(strict_types=1);

namespace App\Badges\Mastodon\Badges;

use Illuminate\Routing\Route;

final class AccountBadge extends AbstractBadge
{
    /**
     * The routes to access this badge.
     *
     * @var array<int, string>
     */
    protected array $routes = [
        '/mastodon/follow/{account}',
    ];

    public function handle(string $account): array
    {
        [$username, $instance] = \explode('@', $account);
        $version = $this->client->get($instance, 'instance')['version'];

        if (\preg_match('/\bPleroma\b/i', $version) !== 0) {
            return (new UserIdBadge($this->client))->handle($username, $instance);
        }

        return (new UserIdBadge($this->client))->handle(
            $this->parseFeed($this->client->rss($instance, $username)),
            $instance,
        );
    }

    public function render(array $properties): array
    {
        return (new UserIdBadge($this->client))->render($properties);
    }

    public function keywords(): array
    {
        return [
        ];
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
            '/mastodon/follow/Gargron@mastodon.social' => 'followers',
            '/mastodon/follow/trumpet@mas.to' => 'followers',
            '/mastodon/follow/admin@cawfee.club' => 'followers (Pleroma)',
        ];
    }

    private function parseFeed(string $feed): ?string
    {
        if (\preg_match('/\/accounts\/avatars\/(\d{3})\/(\d{3})\/(\d{3})/', $feed, $matches)) {
            return \implode('', \array_slice($matches, 1));
        }

        return null;
    }
}
