<?php

declare(strict_types=1);

namespace App\Integrations\DUB\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\FormatStars;
use App\Integrations\DUB\Client;

final class StarsController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $package): array
    {
        $score = $this->client->get("{$package}/stats")['score'];

        return [
            'label'       => 'stars',
            'status'      => FormatStars::execute($score),
            'statusColor' => 'green.600',
        ];
    }
}
