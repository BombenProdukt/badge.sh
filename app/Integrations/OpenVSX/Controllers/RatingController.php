<?php

declare(strict_types=1);

namespace App\Integrations\OpenVSX\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\OpenVSX\Client;

final class RatingController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $namespace, string $package): array
    {
        $response = $this->client->get($namespace, $package);

        return [
            'label'       => 'rating',
            'status'      => $response['averageRating'].'/5',
            'statusColor' => 'green.600',
        ];
    }
}
