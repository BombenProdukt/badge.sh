<?php

declare(strict_types=1);

namespace App\Badges\PeerTube\Badges;

use App\Badges\AbstractBadge;
use App\Badges\PeerTube\Client;
use Illuminate\Routing\Route;
use PreemStudio\Formatter\FormatNumber;

final class FollowersBadge extends AbstractBadge
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
        return [];
    }

    public function routePaths(): array
    {
        return [
            '/peertube/followers/{instance}/{account}/{channel?}',
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
            '/peertube/followers/framatube.org/framasoft'                 => 'followers (account)',
            '/peertube/followers/framatube.org/framasoft/framablog.audio' => 'followers (channel)',
        ];
    }
}
