<?php

declare(strict_types=1);

namespace App\Integrations\CRAN\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\FormatNumber;
use App\Integrations\CRAN\Client;
use Carbon\Carbon;

final class TotalDownloadsController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $package): array
    {
        $genesis = explode('T', Carbon::createFromTimestamp(0)->toISOString())[0];

        return [
            'label'       => 'downloads',
            'status'      => FormatNumber::execute($this->client->logs("downloads/total/{$genesis}:last-day/{$package}")[0]['downloads']),
            'statusColor' => 'green.600',
        ];
    }
}
