<?php

declare(strict_types=1);

namespace App\Integrations\CTAN\Controllers;

use App\Integrations\Actions\FormatStars;
use App\Integrations\CTAN\Client;
use Illuminate\Routing\Controller;

final class StarsController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $package): array
    {
        preg_match('/<span>[^<]*?([\d.]+)\s/i', $this->client->web($package), $matches);

        return [
            'label'       => 'rating',
            'status'      => FormatStars::execute($matches[1]),
            'statusColor' => 'green.600',
        ];
    }
}
