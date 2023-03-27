<?php

declare(strict_types=1);

namespace App\Badges\Mastodon\Badges;

use App\Data\BadgePreviewData;

final class AccountBadge extends AbstractBadge
{
    protected string $route = '/mastodon/follow/{account}';

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

    public function previews(): array
    {
        return [
            new BadgePreviewData(
                name: 'followers',
                path: '/mastodon/follow/Gargron@mastodon.social',
                data: $this->render(['instance' => 'mastodon.social', 'username' => 'linuxxx', 'count' => '1000000']),
            ),
            new BadgePreviewData(
                name: 'followers',
                path: '/mastodon/follow/trumpet@mas.to',
                data: $this->render(['instance' => 'mastodon.social', 'username' => 'linuxxx', 'count' => '1000000']),
            ),
            new BadgePreviewData(
                name: 'followers (Pleroma)',
                path: '/mastodon/follow/admin@cawfee.club',
                data: $this->render(['instance' => 'mastodon.social', 'username' => 'linuxxx', 'count' => '1000000']),
            ),
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
