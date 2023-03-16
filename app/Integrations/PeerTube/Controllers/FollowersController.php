<?php

declare(strict_types=1);

namespace App\Integrations\PeerTube\Controllers;

use App\Integrations\Actions\FormatNumber;
use App\Integrations\PeerTube\Client;
use Illuminate\Routing\Controller;

final class FollowersController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $instance, string $account, ?string $channel = null): array
    {
        if (empty($channel)) {
            return [
                'label'       => 'followers',
                'status'      => FormatNumber::execute($this->client->get($instance, "video-channels/{$channel}")['followersCount']),
                'statusColor' => 'F1680D',
            ];
        }

        return [
            'label'       => 'followers',
            'status'      => FormatNumber::execute($this->client->get($instance, "accounts/{$account}")['followersCount']),
            'statusColor' => 'F1680D',
        ];
    }
}
