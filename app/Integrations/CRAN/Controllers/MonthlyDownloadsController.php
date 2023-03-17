<?php

declare(strict_types=1);

namespace App\Integrations\CRAN\Controllers;

use App\Integrations\AbstractController;
use App\Integrations\Actions\FormatNumber;
use App\Integrations\CRAN\Client;

final class MonthlyDownloadsController extends AbstractController
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    protected function handleRequest(string $package): array
    {
        return [
            'label'       => 'downloads',
            'status'      => FormatNumber::execute($this->client->logs("downloads/total/last-month/{$package}")[0]['downloads']).'/month',
            'statusColor' => 'green.600',
        ];
    }
}
