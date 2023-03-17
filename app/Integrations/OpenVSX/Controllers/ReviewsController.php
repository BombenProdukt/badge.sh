<?php

declare(strict_types=1);

namespace App\Integrations\OpenVSX\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\OpenVSX\Client;

final class ReviewsController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $namespace, string $package): array
    {
        $response = $this->client->get($namespace, $package);

        return [
            'label'       => 'reviews',
            'status'      => $response['reviewCount'],
            'statusColor' => 'green.600',
        ];
    }
}
