<?php

declare(strict_types=1);

namespace App\Integrations\DUB\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\DUB\Client;

final class RatingController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $package): array
    {
        $score = $this->client->get("{$package}/stats")['score'];

        return [
            'label'       => 'rating',
            'status'      => number_format($score / 5, 2),
            'statusColor' => 'green.600',
        ];
    }
}
