<?php

declare(strict_types=1);

namespace App\Integrations\MozillaAddOns\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\FormatNumber;
use App\Integrations\MozillaAddOns\Client;

final class ReviewsController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $package): array
    {
        $response = $this->client->get($package);

        return [
            'label'       => 'reviews',
            'status'      => FormatNumber::execute($response['ratings']['average']),
            'statusColor' => 'green.600',
        ];
    }
}
