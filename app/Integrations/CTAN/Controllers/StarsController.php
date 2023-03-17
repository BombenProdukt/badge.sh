<?php

declare(strict_types=1);

namespace App\Integrations\CTAN\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\FormatStars;
use App\Integrations\CTAN\Client;

final class StarsController extends AbstractController
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
            'status'      => FormatStars::execute($matches[1]),
            'statusColor' => 'green.600',
        ];
    }
}
