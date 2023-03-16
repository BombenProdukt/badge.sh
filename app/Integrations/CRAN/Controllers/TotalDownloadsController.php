<?php

declare(strict_types=1);

namespace App\Integrations\CRAN\Controllers;

use App\Integrations\Actions\FormatNumber;
use App\Integrations\CRAN\Client;
use Carbon\Carbon;
use Illuminate\Routing\Controller;

final class TotalDownloadsController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $package): array
    {
        $genesis = explode('T', Carbon::createFromTimestamp(0)->toISOString())[0];

        return [
            'label'       => 'downloads',
            'status'      => FormatNumber::execute($this->client->logs("downloads/total/{$genesis}:last-day/{$package}")[0]['downloads']),
            'statusColor' => 'green.600',
        ];
    }
}
