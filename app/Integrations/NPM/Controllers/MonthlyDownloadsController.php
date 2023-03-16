<?php

declare(strict_types=1);

namespace App\Integrations\NPM\Controllers;

use App\Integrations\Actions\FormatNumber;
use App\Integrations\NPM\Client;
use Illuminate\Routing\Controller;

final class MonthlyDownloadsController extends Controller
{
    public function __construct(private readonly Client $client)
    {
        //
    }

    public function __invoke(string $package, string $tag = 'latest'): array
    {
        $downloads = $this->client->api("downloads/point/last-month/{$package}")['downloads'];

        return [
            'label'       => 'downloads',
            'status'      => FormatNumber::execute($downloads).'/month',
            'statusColor' => 'green.600',
        ];
    }
}
