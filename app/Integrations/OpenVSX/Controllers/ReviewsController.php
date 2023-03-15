<?php

declare(strict_types=1);

namespace App\Integrations\OpenVSX\Controllers;

use App\Integrations\OpenVSX\Client;
use Illuminate\Routing\Controller;

final class ReviewsController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $namespace, string $package): array
    {
        $response = $this->client->get($namespace, $package);

        return [
            'label'       => 'reviews',
            'status'      => $response['reviewCount'],
            'statusColor' => 'green.600',
        ];
    }
}
