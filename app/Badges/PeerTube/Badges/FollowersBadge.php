<?php

declare(strict_types=1);

namespace App\Badges\PeerTube\Badges;

use App\Badges\PeerTube\Client;
use App\Contracts\Badge;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class FollowersBadge implements Badge
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function handle(string $instance, string $account, ?string $channel = null): array
    {
        if (empty($channel)) {
            $response = $this->client->get($instance, "video-channels/{$channel}");
        } else {
            $response = $this->client->get($instance, "accounts/{$account}");
        }

        if (isset($response['data'])) {
            $followersCount = collect($response['data'])->sum('followersCount');
        } else {
            $followersCount = $response['followersCount'];
        }

        return [
            'label'        => 'followers',
            'message'      => FormatNumber::execute($followersCount),
            'messageColor' => 'F1680D',
        ];
    }

    public function service(): string
    {
        return 'PeerTube';
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
            '/peertube/{instance}/{account}/followers/{channel?}',
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
            '/peertube/framatube.org/framasoft/followers'                 => 'followers (account)',
            '/peertube/framatube.org/framasoft/followers/framablog.audio' => 'followers (channel)',
        ];
    }

    public function deprecated(): array
    {
        return [
            //
        ];
    }
}