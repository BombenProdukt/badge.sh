<?php

declare(strict_types=1);

namespace App\Integrations\CRAN\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\FormatNumber;
use App\Integrations\CRAN\Client;

final class DependentsController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $package): array
    {
        $response = $this->client->db("/-/revdeps/{$package}");

        return [
            'label'       => 'dependents',
            'status'      => FormatNumber::execute(count($response[$package]['Depends'])),
            'statusColor' => 'green.600',
        ];
    }
}
