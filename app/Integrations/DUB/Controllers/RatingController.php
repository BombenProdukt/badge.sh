<?php

declare(strict_types=1);

namespace App\Integrations\DUB\Controllers;

use App\Integrations\DUB\Client;
use Illuminate\Routing\Controller;

final class RatingController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $package): array
    {
        $score = $this->client->get("{$package}/stats")['score'];

        return [
            'label'       => 'rating',
            'status'      => number_format($score / 5, 2),
            'statusColor' => 'green.600',
        ];
    }
}
