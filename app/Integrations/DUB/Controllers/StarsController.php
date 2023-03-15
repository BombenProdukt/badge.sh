<?php

declare(strict_types=1);

namespace App\Integrations\DUB\Controllers;

use App\Integrations\Actions\FormatStars;
use App\Integrations\DUB\Client;
use Illuminate\Routing\Controller;

final class StarsController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $package): array
    {
        $score = $this->client->get("{$package}/stats")['score'];

        return [
            'label'       => 'stars',
            'status'      => FormatStars::execute($score),
            'statusColor' => 'green.600',
        ];
    }
}
