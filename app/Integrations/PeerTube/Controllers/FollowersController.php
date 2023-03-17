<?php

declare(strict_types=1);

namespace App\Integrations\PeerTube\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\FormatNumber;
use App\Integrations\PeerTube\Client;

final class FollowersController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $instance, string $account, ?string $channel = null): array
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
            'label'       => 'followers',
            'status'      => FormatNumber::execute($followersCount),
            'statusColor' => 'F1680D',
        ];
    }
}
