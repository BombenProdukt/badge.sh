<?php

declare(strict_types=1);

namespace App\Integrations\Twitter\Controllers;

use App\Integrations\Actions\FormatNumber;
use App\Integrations\Twitter\Client;
use Illuminate\Routing\Controller;

final class FollowController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $username): array
    {
        $response = $this->client->get($username);

        return [
            'label'       => "follow @{$username}",
            'status'      => FormatNumber::execute($response['followers_count']),
            'statusColor' => '1da1f2',
        ];
    }
}
