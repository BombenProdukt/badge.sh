<?php

declare(strict_types=1);

namespace App\Integrations\Reddit\Controllers;

use App\Integrations\Actions\FormatNumber;
use App\Integrations\Reddit\Client;
use Illuminate\Routing\Controller;

final class SubscribersController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $subreddit): array
    {
        $response = $this->client->get("r/{$subreddit}/about.json");

        return [
            'label'       => "r/{$subreddit}",
            'status'      => FormatNumber::execute($response['subscribers']).' subscribers',
            'statusColor' => 'ff4500',
        ];
    }
}
