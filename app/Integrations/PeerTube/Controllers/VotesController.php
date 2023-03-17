<?php

declare(strict_types=1);

namespace App\Integrations\PeerTube\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\FormatNumber;
use App\Integrations\PeerTube\Client;

final class VotesController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $instance, string $video, ?string $format = null): array
    {
        $response = $this->client->get($instance, "videos/{$video}");

        if ($format === 'likes') {
            return [
                'label'       => 'votes',
                'status'      => FormatNumber::execute($response['likes']),
                'statusColor' => 'F1680D',
            ];
        }

        if ($format === 'dislikes') {
            return [
                'label'       => 'votes',
                'status'      => FormatNumber::execute($response['dislikes']),
                'statusColor' => 'F1680D',
            ];
        }

        return [
            'label'       => 'votes',
            'status'      => sprintf('%s 👍 %s 👎', FormatNumber::execute($response['likes']), FormatNumber::execute($response['dislikes'])),
            'statusColor' => 'F1680D',
        ];
    }
}
