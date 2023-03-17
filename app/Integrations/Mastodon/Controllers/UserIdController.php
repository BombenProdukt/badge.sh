<?php

declare(strict_types=1);

namespace App\Integrations\Mastodon\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\FormatNumber;
use App\Integrations\Mastodon\Client;

final class UserIdController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $userId, ?string $instance = 'mastodon.social'): array
    {
        $response = $this->client->get($instance, "accounts/{$userId}");
        $account  = $response['username']."@{$instance}";

        return [
            'label'       => "follow @{$account}",
            'status'      => FormatNumber::execute($response['followers_count']),
            'statusColor' => '3487CE',
        ];
    }
}
