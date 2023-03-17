<?php

declare(strict_types=1);

namespace App\Integrations\Pub\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\FormatNumber;
use App\Integrations\Pub\Client;

final class LikesController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $package): array
    {
        $likeCount = $this->client->api("packages/{$package}/score")['likeCount'];

        return [
            'label'       => 'popularity',
            'status'      => FormatNumber::execute($likeCount),
            'statusColor' => 'green.600',
        ];
    }
}
