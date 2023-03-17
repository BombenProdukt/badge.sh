<?php

declare(strict_types=1);

namespace App\Integrations\ChromeWebStore\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\ChromeWebStore\Client;

/**
 * @TODO
 */
final class RatingController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $itemId): array
    {
        $response = $this->client->get($itemId);

        return [
            'label'       => 'TODO',
            'status'      => 'TODO',
            'statusColor' => 'TODO',
        ];
    }
}
