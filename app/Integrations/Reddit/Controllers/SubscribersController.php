<?php

declare(strict_types=1);

namespace App\Integrations\Reddit\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\FormatNumber;
use App\Integrations\Reddit\Client;

final class SubscribersController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $subreddit): array
    {
        $response = $this->client->get("r/{$subreddit}/about.json");

        return [
            'label'       => "r/{$subreddit}",
            'status'      => FormatNumber::execute($response['subscribers']).' subscribers',
            'statusColor' => 'ff4500',
        ];
    }
}
