<?php

declare(strict_types=1);

namespace App\Integrations\OpenCollective\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\FormatNumber;
use App\Integrations\OpenCollective\Client;

final class ContributorsController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $slug): array
    {
        $response = $this->client->get($slug);

        return [
            'label'       => 'contributors',
            'status'      => FormatNumber::execute($response['contributorsCount']),
            'statusColor' => 'green.600',
        ];
    }
}
