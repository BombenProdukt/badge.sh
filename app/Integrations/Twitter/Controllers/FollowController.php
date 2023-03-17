<?php

declare(strict_types=1);

namespace App\Integrations\Twitter\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\FormatNumber;
use App\Integrations\Twitter\Client;

final class FollowController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $username): array
    {
        $response = $this->client->get($username);

        return [
            'label'       => "follow @{$username}",
            'status'      => FormatNumber::execute($response['followers_count']),
            'statusColor' => '1da1f2',
        ];
    }
}
