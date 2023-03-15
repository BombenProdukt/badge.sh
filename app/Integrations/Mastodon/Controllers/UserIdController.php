<?php

declare(strict_types=1);

namespace App\Integrations\Mastodon\Controllers;

use App\Integrations\Actions\FormatNumber;
use App\Integrations\Mastodon\Client;
use Illuminate\Routing\Controller;

final class UserIdController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $userId, ?string $instance = 'mastodon.social'): array
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
