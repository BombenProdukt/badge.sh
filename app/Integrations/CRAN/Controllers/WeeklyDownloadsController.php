<?php

declare(strict_types=1);

namespace App\Integrations\CRAN\Controllers;

use App\Integrations\Actions\FormatNumber;
use App\Integrations\CRAN\Client;
use Illuminate\Routing\Controller;

final class WeeklyDownloadsController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $package): array
    {
        return [
            'label'       => 'downloads',
            'status'      => FormatNumber::execute($this->client->logs("downloads/total/last-week/{$package}")[0]['downloads']).'/week',
            'statusColor' => 'green.600',
        ];
    }
}
