<?php

declare(strict_types=1);

namespace App\Integrations\PeerTube\Controllers;

use App\Integrations\Actions\FormatNumber;
use App\Integrations\PeerTube\Client;
use Illuminate\Routing\Controller;

final class CommentsController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $instance, string $video): array
    {
        $response = $this->client->get($instance, "videos/{$video}/comment-threads");

        return [
            'label'       => 'comments',
            'status'      => FormatNumber::execute($response['total']),
            'statusColor' => 'F1680D',
        ];
    }
}
