<?php

declare(strict_types=1);

namespace App\Integrations\CTAN\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\CTAN\Client;

final class RatingController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $package): array
    {
        preg_match('/<span>[^<]*?([\d.]+)\s/i', $this->client->web($package), $matches);

        return [
            'label'       => 'rating',
            'status'      => number_format((float) $matches[1], 2).'/5',
            'statusColor' => 'green.600',
        ];
    }
}
