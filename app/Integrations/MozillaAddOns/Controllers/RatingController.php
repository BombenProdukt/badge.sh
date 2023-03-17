<?php

declare(strict_types=1);

namespace App\Integrations\MozillaAddOns\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\MozillaAddOns\Client;

final class RatingController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $package): array
    {
        $response = $this->client->get($package);

        return [
            'label'       => 'rating',
            'status'      => (string) $response['ratings']['count'],
            'statusColor' => 'green.600',
        ];
    }
}
