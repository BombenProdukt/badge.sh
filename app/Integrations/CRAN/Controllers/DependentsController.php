<?php

declare(strict_types=1);

namespace App\Integrations\CRAN\Controllers;

use App\Integrations\Actions\FormatNumber;
use App\Integrations\CRAN\Client;
use Illuminate\Routing\Controller;

final class DependentsController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $package): array
    {
        $response = $this->client->db("/-/revdeps/{$package}");

        return [
            'label'       => 'dependents',
            'status'      => FormatNumber::execute(count($response[$package]['Depends'])),
            'statusColor' => 'green.600',
        ];
    }
}
