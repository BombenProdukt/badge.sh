<?php

declare(strict_types=1);

namespace App\Integrations\PeerTube\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\FormatNumber;
use App\Integrations\PeerTube\Client;

final class ViewsController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $instance, string $video): array
    {
        $response = $this->client->get($instance, "videos/{$video}");

        return [
            'label'       => 'views',
            'status'      => FormatNumber::execute($response['views']),
            'statusColor' => 'F1680D',
        ];
    }
}
